<?php

use App\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
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
Route::resource('category','CategoryController');
Route::resource('color','ColorController');
Route::resource('product','ProductController');

//upload image
Route::post('/upload', [ImageController::class, 'store'])->name('upload');

//return post images
Route::get('/media/{product}', [ImageController::class, 'getImages'])->name('product.images');

// Route::resource('variant','variationController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
