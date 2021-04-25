<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthLoginController;
use App\Http\Controllers\API\AuthRegisterController;

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


Route::group(['prefix'=> 'photoshoots/v1'], function () {

    Route::post('/register', [AuthRegisterController::class, 'register'])->name('api.v1.register');
    Route::post('/login', [AuthLoginController::class, 'login'])->name('api.v1.login');

    Route::group(['middleware'=> 'auth:sanctum'], function () {
        Route::post('/logout', [AuthLoginController::class, 'logout'])->name('api.v1.logout');

        Route::group(['prefix'=>'photographer', 'middleware'=>'photographer'], function () {
            
        });

        Route::group(['prefix'=>'productowner', 'middleware'=>'productowner'], function () {
            
        });
    });
});
