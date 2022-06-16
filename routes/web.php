<?php

// use App\Http\Controllers\ProductController;
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

Route::get('/{any?}', function () {
    return view('app');
});
// route fot product
Route::get('product-list', 'ProductController@productlist')->name('productlist');
Route::get('add-new-product', 'ProductController@addNewPrduct')->name('addNewPrduct');
Route::post('save-product','ProductController@saveProduct')->name('saveProduct');

// Route::get('/product/create', [ProductController\Create::class, 'index']);
// Route::post('/product/create', [ProductController\Create::class, 'store'])->name('product.create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
