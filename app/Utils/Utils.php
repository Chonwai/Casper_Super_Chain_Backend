<?php

namespace App\Utils;

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
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() / 60 / 24 . " Day",
        ];
    }

    public static function refreshToken()
    {
        return self::respondWithToken(auth()->refresh());
    }
}
