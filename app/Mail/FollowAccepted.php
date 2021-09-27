<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $follow;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($follow)
    {
        $this->follow = $follow;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sales@853.ai', 'Casper Team')->view('emails.FollowAccepted');
    }
}
