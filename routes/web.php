<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DropzoneController;

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


Route::group(["middleware" => 'auth'], function(){


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);

Route::post('get-sub-categories',[CategoryController::class, 'getSubCateList']);
Route::get('get-categorywise-products',[CategoryController::class, 'getCategoryProducts'])->name('category.products');


// Route::get('dropzone', [DropzoneController::class, "dropzone"]);
Route::post('dropzone/store/{id}', [DropzoneController::class, "dropzoneStore"])->name('dropzone.store');

Route::get('/tasks', [ProductController::class,'exportCsv']);


});

