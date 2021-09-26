<?php

namespace App\Services;

use App\Mail\NewFollowRequest;
use App\Mail\ValidateRegistration;
use Illuminate\Support\Facades\Mail;

class MailServices
{
    private static $_instance = null;

    private function __construct()
    {
        // Avoid constructing this class on the outside.
    }

    private function __clone()
    {
        // Avoid cloning this class on the outside.
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function sendValidateRegistration($validateLink, $user)
    {
        $mailValidate = new ValidateRegistration($validateLink, $user);
        Mail::to($user->email)->send($mailValidate->build());
    }

    public function sendNewFollowRequest($follow)
    {
        $mailValidate = new NewFollowRequest($follow);
        Mail::to($follow->addressee->email)->send($mailValidate->build());
    }
}
