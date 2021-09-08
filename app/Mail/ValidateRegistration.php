<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidateRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $validateLink;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validateLink, $user)
    {
        $this->validateLink = $validateLink;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sales@853.ai', 'Casper Team')->view('emails.ValidationMail');
    }
}
