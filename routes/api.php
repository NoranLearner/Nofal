<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\PhoneVerificationController;

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

Route::middleware('set_app_lang')->prefix('{locale}')->group(function () {

    Route::post('/register', [RegisterController::class, 'register']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/password/forget-password', [ForgetPasswordController::class, 'forgetPassword']);

    Route::post('/password/reset-password', [ResetPasswordController::class, 'resetPassword']);

});

Route::middleware(['auth:sanctum', 'set_app_lang'])->prefix('{locale}')->group(function () {

    Route::post('/phone-verification', [PhoneVerificationController::class, 'phone_verification']);

});
