<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\MainController::class,'index'])->name('web.meja');
Route::get('menu/{id}',[App\Http\Controllers\MainController::class,'menu'])->name('web.menu');
Route::get('waiting/{id}',[App\Http\Controllers\MainController::class,'wait'])->name('waiting-list');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faker', [App\Http\Controllers\MainController::class, 'faker'])->name('faker');
Route::prefix('carts')->group(function () {
    Route::get('{id}',[App\Http\Controllers\MainController::class,'SeeCart'])->name('li-cart');
});
Route::prefix('order')->group(function () {
    Route::get('{id}',[App\Http\Controllers\MainController::class,'orders'])->name('make-order');
});

Route::get('bayar/{id}',[App\Http\Controllers\MainController::class,'bayar'])->name('bayar');
Route::get('barcode/{id}',[App\Http\Controllers\MainController::class,'barcode'])->name('barcode');
