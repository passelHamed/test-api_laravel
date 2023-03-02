<?php

namespace App\Jobs;

use App\Mail\NewPostMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $postsDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $postsDetails)
    {
        $this->email = $email;
        $this->postsDetails = $postsDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to(
            $this->email,
        )->send(
            new NewPostMail(
                $this->postsDetails,
            ),
        );
    }
}
