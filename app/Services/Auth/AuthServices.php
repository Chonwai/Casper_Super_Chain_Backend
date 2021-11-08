<?php

namespace App\Services\Auth;

use App\Models\Users;
use App\Services\MailServices;
use App\Utils\JWTUtils;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServices
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

    public static function index(Request $request) {
        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return ['error' => 'Unauthorized'];
        } else {
            $user = JWTAuth::user();
            // $user->token = Utils::respondWithToken($token);
            return $user;
        }
    }

    public function store(Request $request)
    {
        $user = new Users($request->all());
        $user->password = bcrypt($request->password);
        $user->id = Utils::generateUUID();
        $user->last_activity_at = Carbon::now();
        $user->auth_token = hash('sha256', Str::random(60));
        $user->ip_address = $request->ip();

        if ($user->save()) {
            $this->sendRegistrationEmail($user);
            $token = Utils::respondWithToken(JWTAuth::fromUser($user));
            $user->token = $token;
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
