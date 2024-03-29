<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MarketingRegisterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Follow\FollowController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Room\RoomUsersController;
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

Route::group(['middleware' => ['api.refresh']], function () {
    Route::prefix('/v1')->group(function () {
        /**
         * User API ------------------------------------------------------------
         *
         * @api
         */
        // Get the Friends List API
        Route::get('/user/follow', [FollowController::class, 'showUserFriend']);
    
        // Get the Items List API
        Route::get('/user/items', [ItemController::class, 'showSelfItem']);

        /**
         * Follow API ------------------------------------------------------------
         *
         * @api
         */
        // Send Follow Request API
        Route::post('/user/follow', [FollowController::class, 'store']);

        // Send Follow Request API
        Route::put('/user/follow/accept', [FollowController::class, 'update']);

        // Get the Follow Request List API
        Route::get('/user/follow/request', [FollowController::class, 'showFollowRequest']);

        // Get the Last 7 Days Follow Accepted List API
        Route::get('/user/follow/accept', [FollowController::class, 'showFollowAccepted']);

        /**
         * Item API ------------------------------------------------------------
         *
         * @api
         */
        // Add New Item API
        Route::post('/item', [ItemController::class, 'store']);

        // Get the Specific Item API
        Route::get('/item/{id}', [ItemController::class, 'show']);

        // Update the Item API
        Route::put('/item/{id}', [ItemController::class, 'update']);

        // Delete the Item API
        Route::delete('/item/{id}', [ItemController::class, 'destroy']);

        /**
         * Order API ------------------------------------------------------------
         *
         * @api
         */
        // Add New Order API
        Route::post('/order', [OrderController::class, 'store']);

        /**
         * Message API ------------------------------------------------------------
         *
         * @api
         */
        // Add New Message API
        Route::post('/message', [MessageController::class, 'store']);

        // Get Messages By Room ID API
        Route::get('/message/room/{id}', [MessageController::class, 'showRoomMessage']);

        /**
         * Room API ------------------------------------------------------------
         *
         * @api
         */
        // Get the Room Member API
        Route::get('/room/{id}/member', [RoomUsersController::class, 'show']);
    });
});
