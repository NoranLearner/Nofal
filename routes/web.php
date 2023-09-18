<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// define('PAGINATION_COUNT',4);

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register'=>false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth:web'], function() {

    Route::resource('posts', PostController::class);

    Route::delete('/imageDelete/{id}',[PostController::class,'imageDelete']);

    Route::delete('/coverDelete/{id}',[PostController::class,'coverDelete']);

    Route::delete('/selected-post', [PostController::class, 'deleteSelect']);

});
