<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthLoginController;
use App\Http\Controllers\API\AuthRegisterController;
use App\Http\Controllers\ProductOwner\PhotoshootRequestController as ProductOwnerPhotoshootRequestController;
use App\Http\Controllers\Photographer\PhotoshootRequestController as PhotographerPhotoshootRequestController;
use App\Http\Controllers\ProductOwner\PhotoshootController as ProductOwnerPhotoshootController;
use App\Http\Controllers\Photographer\PhotoshootController as PhotographerPhotoshootController;
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
            Route::group(['prefix'=>'photoshootrequest'], function (){
                Route::get('/available', [PhotographerPhotoshootRequestController::class, 'available'])
                ->name('api.v1.available-shoots');
            });

            Route::group(['prefix'=>'photoshoot'], function (){
                Route::post('/upload', [PhotographerPhotoshootController::class, 'upload'])->name('api.v1.photoshoot-upload');
            });
        });

        Route::group(['prefix'=>'productowner', 'middleware'=>'productowner'], function () {

            Route::group(['prefix'=>'photoshootrequest'], function (){
                Route::post('/store', [ProductOwnerPhotoshootRequestController::class, 'store'])
                ->name('api.v1.request-photoshoot');
            });

            Route::group(['prefix'=>'photoshoot'], function (){
                Route::post('/approve', [ProductOwnerPhotoshootController::class, 'approve'])->name('api.v1.photoshoot-approve');
                Route::get('/view/sample', [ProductOwnerPhotoshootController::class, 'sample'])->name('api.v1.photoshoot-sample');
            });
            
        });
    });
});

