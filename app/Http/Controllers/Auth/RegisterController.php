<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Templates\Flows\AuthTemplate;
use App\Utils\Utils;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register new user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $flow = new AuthTemplate();

        $res = $flow->takeFlow($request, 'JsonResource', 'store');
        
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
