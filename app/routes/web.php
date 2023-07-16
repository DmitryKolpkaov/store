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
Route::prefix('admin')->get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->middleware('is_admin')->name('orders');

//Категории в админке
Route::prefix('admin')->resource('categories', 'App\Http\Controllers\Admin\CategorryController')->middleware('is_admin');
Route::get('admin/categories', 'App\Http\Controllers\Admin\CategorryController@index')->middleware('is_admin')->name('categories.index');

//Товары в админке
Route::prefix('admin')->resource('products', 'App\Http\Controllers\Admin\ProductController')->middleware('is_admin');
Route::get('admin/products', 'App\Http\Controllers\Admin\ProductController@index')->middleware('is_admin')->name('products.index');
Route::get('admin/products/show', 'App\Http\Controllers\Admin\ProductController@show')->middleware('is_admin')->name('products.show');
Route::get('admin/products/edit', 'App\Http\Controllers\Admin\ProductController@edit')->middleware('is_admin')->name('products.edit');
Route::get('admin/products/create', 'App\Http\Controllers\Admin\ProductController@create')->middleware('is_admin')->name('products.create');
Route::post('admin/products/store', 'App\Http\Controllers\Admin\ProductController@store')->middleware('is_admin')->name('products.store');
Route::put('admin/products/update', 'App\Http\Controllers\Admin\ProductController@update')->middleware('is_admin')->name('products.update');



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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
