<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Templates\Flows\AuthTemplate;
use App\Utils\Utils;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $flow = new AuthTemplate();

        $res = $flow->takeFlow($request, 'JsonResource', 'index');
        
        return $res;
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return Utils::refreshToken();
    }
}
