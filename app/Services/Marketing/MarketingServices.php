<?php

namespace App\Services\Marketing;

use App\Models\Users;
use App\Services\MailServices;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketingServices
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

    public function store(Request $request)
    {
        $user = new Users($request->all());
        $user->id = Utils::generateUUID();
        $user->password = bcrypt(Utils::generateUUID());
        $user->last_activity_at = Carbon::now();
        $user->auth_token = hash('sha256', Str::random(60));
        $user->ip_address = $request->ip();
        $user->save();

        if ($user->wasChanged()) {
            $this->sendRegistrationEmail($user);
        }

        return $user;
    }

    public function sendRegistrationEmail($user)
    {
        $host = env('APP_HOST', 'http://localhost:8000');
        $validateMailURL = "$host/api/v1/user/$user->id/mail/$user->auth_token";
        MailServices::getInstance()->sendValidateRegistration($validateMailURL, $user);
    }
}
