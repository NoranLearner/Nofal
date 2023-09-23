<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace'=>'Api/Admin', 'middleware'=>['changeLang']],function(){

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/register', [AuthController::class, 'register']);

    Route::group(['middleware'=>['auth.guard:admin-api']],function(){

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/profile', [AuthController::class, 'profile']);

        Route::post('/refresh', [AuthController::class, 'refresh']);

    });

});
