<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostMail extends Mailable
{
    use Queueable, SerializesModels;

    public $postsDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postsDetails)
    {
        $this->postsDetails = $postsDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
        $this->subject(
            'Inisev Test',
        )->view(
            'mails.PostMail', $this->postsDetails,
        );
    }
}
