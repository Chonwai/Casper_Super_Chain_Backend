<?php

use App\Http\Controllers\Auth\LoginController;
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

    /**
     * Order API ------------------------------------------------------------
     *
     * @api
     */
    // All Order API
    Route::get('/order/all', [OrderController::class, 'index']);
});

// Route::middleware('auth:api')->prefix('/v1')->group(function () {
//     /**
//      * User API ------------------------------------------------------------
//      *
//      * @api
//      */
//     // Login API
//     Route::post('/auth/login', [LoginController::class, 'refresh']);
// });
