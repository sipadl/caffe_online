<?php

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
Route::post('meja',[App\Http\Controllers\MainController::class,'setMeja'])->name('mejas');

Route::prefix('carts')->group(function () {
    Route::post('',[App\Http\Controllers\MainController::class,'SeeCart'])->name('li-cart');
    Route::post('',[App\Http\Controllers\MainController::class,'Cart'])->name('cart');
    Route::post('plus',[App\Http\Controllers\MainController::class,'addCart'])->name('add-cart');
    Route::post('minus',[App\Http\Controllers\MainController::class,'minusCart'])->name('minus-cart');
    Route::post('delete',[App\Http\Controllers\MainController::class,'deleteItems'])->name('delete-cart');
});

Route::prefix('post-order')->group(function () {
    Route::post('',[App\Http\Controllers\MainController::class, 'post_detail'])->name('detail-orders');
});
Route::post('last-step',[App\Http\Controllers\MainController::class,'last'])->name('last');
