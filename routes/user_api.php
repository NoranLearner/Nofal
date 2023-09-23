<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\PostController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group(['namespace'=>'Api/User', 'middleware'=>['changeLang']],function(){

        Route::post('/get-all-posts', [PostController::class, 'index']);

        Route::post('/post-details', [PostController::class, 'postDetails']);

        Route::post('/create-post', [PostController::class, 'create']);

        Route::post('/delete-post', [PostController::class, 'destroy']);

        Route::post('/update-post', [PostController::class, 'update']);

        Route::post('/register', [AuthController::class, 'register']);

        Route::post('/login', [AuthController::class, 'login']);

        Route::group(['middleware'=>['auth.guard:user-api']],function(){

            Route::post('/logout', [AuthController::class, 'logout']);

            Route::post('/profile', [AuthController::class, 'profile']);

            Route::post('/refresh', [AuthController::class, 'refresh']);

        });

});
