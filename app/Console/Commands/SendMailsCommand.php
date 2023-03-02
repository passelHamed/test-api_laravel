<?php

namespace App\Console\Commands;

use App\Jobs\NewPostJob;
use App\Models\SendPosts;
use App\Models\Subscribe;
use Illuminate\Console\Command;

class SendMailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:posts-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send posts mail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscribers = Subscribe::with('website')->get();
        
        foreach ($subscribers as $subscriber) {
            $email = $subscriber->email;
            $allPosts = $subscriber->website->posts;
            $postsIDs = [];
            $postsDetails = [];

            foreach ($allPosts as $post) {
                array_push($postsIDs, $post->id);
            }   

            $sendPosts = SendPosts::where('subscriber_id', $subscriber->id)->whereIn('post_id', $postsIDs)->pluck('post_id')->toArray();

            foreach ($allPosts as $post) {
                if (!in_array($post->id, $sendPosts)) {
                    array_push($postsDetails, $post);
                    SendPosts::create([
                        'post_id' => $post->id,
                        'subscriber_id' => $subscriber->id,
                    ]);
                }
            }
            
            if (!empty($postsDetails)) {
                dispatch(new NewPostJob($email, $postsDetails));
            }
        }

        return Command::SUCCESS;
    }
}
