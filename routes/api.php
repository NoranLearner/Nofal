<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\PhoneVerificationController;
use App\Http\Controllers\Api\Auth\ResetPasswordEmailController;
use App\Http\Controllers\Api\Auth\ResetPasswordPhoneController;
use App\Http\Controllers\Api\Auth\ForgetPasswordEmailController;
use App\Http\Controllers\Api\Auth\ForgetPasswordPhoneController;

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

Route::middleware('set_app_lang')->prefix('{locale}')->group(function () {

    Route::post('/register', [RegisterController::class, 'register']);

    Route::post('/login', [LoginController::class, 'login']);

    // Route::post('/password/forget-password', [ForgetPasswordEmailController::class, 'forgetPassword']);

    // Route::post('/password/reset-password', [ResetPasswordEmailController::class, 'resetPassword']);

    Route::post('/password/forget-password', [ForgetPasswordPhoneController::class, 'forgetPassword']);

    Route::post('/password/reset-password', [ResetPasswordPhoneController::class, 'resetPassword']);

});

Route::middleware(['auth:sanctum', 'set_app_lang'])->prefix('{locale}')->group(function () {

    // Route::post('/email-verification', [EmailVerificationController::class, 'email_verification']);

    // Route::get('/email-verification', [EmailVerificationController::class, 'send_email_verification']);

    Route::post('/phone-verification', [PhoneVerificationController::class, 'phone_verification']);

    Route::get('/phone-verification', [PhoneVerificationController::class, 'send_phone_verification']);

});
