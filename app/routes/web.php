<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('get-logout');


//Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->middleware('auth')->name('orders');
Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->middleware('is_admin')->name('orders');


Route::get('/', 'App\Http\Controllers\MainController@index')->name('index');

//Корзина
Route::prefix('basket')->group(function(){
    Route::post('/add/{id}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');

    Route::middleware('basket_not_empty')->group(function(){
        Route::get('/', 'App\Http\Controllers\BasketController@basket')->name('basket');
        Route::get('/place', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
        Route::post('/confirm', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
        Route::post('/remove/{id}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
    });
});





Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');
Route::get('/{category}', 'App\Http\Controllers\MainController@category')->name('category');
Route::get('/{category}/{product?}', 'App\Http\Controllers\MainController@product')->name('product');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
