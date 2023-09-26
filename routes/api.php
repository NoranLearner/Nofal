<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'Api'],function(){

    Route::post('/addCategory', [CategoryController::class, 'addCategory']);

    Route::post('/addProduct', [ProductController::class, 'addProduct']);

    Route::post('/updateProduct', [ProductController::class, 'updateProduct']);

    Route::delete('/delExpProduct', [ProductController::class, 'delExpProduct']);

    Route::get('/mostProductCat', [CategoryController::class, 'mostProductCat']);

    Route::post('/highPrice', [ProductController::class, 'highPrice']);

});
