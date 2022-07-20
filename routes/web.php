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

// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\MainController::class,'index'])->name('web.meja');
Route::get('menu/{id}',[App\Http\Controllers\MainController::class,'menu'])->name('web.menu');
Route::get('waiting/{id}',[App\Http\Controllers\MainController::class,'wait'])->name('waiting-list');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faker', [App\Http\Controllers\MainController::class, 'faker'])->name('faker');
Route::prefix('carts')->group(function () {
    Route::get('{id}',[App\Http\Controllers\MainController::class,'SeeCart'])->name('li-cart');
});
Route::prefix('order')->group(function () {
    Route::get('{id}',[App\Http\Controllers\MainController::class,'orders'])->name('make-order');
});

Route::get('bayar/{id}',[App\Http\Controllers\MainController::class,'bayar'])->name('bayar');
Route::get('nota/{id}',[App\Http\Controllers\MainController::class,'nota'])->name('nota');
Route::get('barcode/{id}',[App\Http\Controllers\MainController::class,'barcode'])->name('barcode');

Route::get('logins', function(){
    return view('web.admin.login_admin');
})->name('logins');

Route::get('logouts', [App\Http\Controllers\HomeController::class, 'logouts'])->name('logouts');
Route::post('post_login', [App\Http\Controllers\HomeController::class, 'post_login'])->name('post_login');
Route::prefix('admin')->group(function () {
        Route::get('',[App\Http\Controllers\HomeController::class,'admins'])->name('admin');
        Route::prefix('meja')->group(function () {
            Route::get('',[App\Http\Controllers\HomeController::class,'mejas'])->name('meja');
            Route::get('add',[App\Http\Controllers\HomeController::class, 'plusmeja'])->name('plus-meja');
            Route::get('reset',[App\Http\Controllers\HomeController::class, 'resetMeja'])->name('reset-meja');
            Route::get('resetBy/{id}',[App\Http\Controllers\HomeController::class, 'resetMejaById'])->name('reset-meja-id');
        });
        Route::prefix('menu')->group(function () {
            Route::get('',[App\Http\Controllers\HomeController::class,'menus'])->name('menus');
            Route::get('add',[App\Http\Controllers\HomeController::class,'addMenus'])->name('add-menus');
            Route::post('add-post',[App\Http\Controllers\HomeController::class,'addMenus'])->name('post-menus');
            Route::get('edit/{id}',[App\Http\Controllers\HomeController::class,'edit'])->name('edit-menus');
            Route::post('edit_menus/{id}',[App\Http\Controllers\HomeController::class,'editMenus'])->name('epost-menus');
            Route::get('delete/{id}',[App\Http\Controllers\HomeController::class,'deleteMenus'])->name('delete-menus');
        });

        Route::prefix('orders')->group(function () {
            Route::get('',[App\Http\Controllers\HomeController::class,'orders'])->name('orders');
            Route::get('{id}',[App\Http\Controllers\HomeController::class,'ordersDetail'])->name('orders-detail');
        });
    });
