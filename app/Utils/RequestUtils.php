<?php

namespace App\Utils;

use App\Utils\JWTUtils;
use Illuminate\Http\Request;

class RequestUtils
{
    /**
     * Add the User ID to request from JWT
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public static function addUserIDFromJWT(Request $request)
    {
        $request->request->add(['id' => JWTUtils::getUserID()]);
    }
}
