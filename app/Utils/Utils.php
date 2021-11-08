<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Utils
{
    public static function integradeResponseMessage($message, $status, $code = 9000)
    {
        $response = [];
        $response['status'] = $status;
        $response['code'] = $code;
        $response['message'] = $message;
        return $response;
    }

    public static function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() / 60 / 24 . " Day",
        ];
    }

    public static function refreshToken()
    {
        return self::respondWithToken(auth()->refresh());
    }

    public static function generateUUID()
    {
        $id = Str::uuid()->toString();
        return $id;
    }
}
