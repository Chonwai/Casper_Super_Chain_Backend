<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MarketingRegisterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Follow\FollowController;
use App\Http\Controllers\Order\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    /**
     * User API ------------------------------------------------------------
     *
     * @api
     */
    // Login API
    Route::post('/auth/login', [LoginController::class, 'login']);

    // Register API
    Route::post('/auth/register', [RegisterController::class, 'store']);

    // Marketing Register API
    Route::post('/auth/register/marketing', [MarketingRegisterController::class, 'store']);

    /**
     * Order API ------------------------------------------------------------
     *
     * @api
     */
    // All Order API
    Route::get('/order/all', [OrderController::class, 'index']);
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::prefix('/v1')->group(function () {
        /**
         * User API ------------------------------------------------------------
         *
         * @api
         */
        // Get the Friends List
        Route::get('/user/follow', [FollowController::class, 'showUserFriend']);

        /**
         * Follow API ------------------------------------------------------------
         *
         * @api
         */
        // Send Follow Request API
        Route::post('/user/follow', [FollowController::class, 'store']);

        // Send Follow Request API
        Route::put('/user/follow/accept', [FollowController::class, 'update']);

        // Get the Follow Request List
        Route::get('/user/follow/request', [FollowController::class, 'showFollowRequest']);
    });
});
