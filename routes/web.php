<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
//     return view('index');
// });

Route::get('', [ProductController::class, 'index']);
Route::post('', [ProductController::class, 'index']);
Route::get('/', [ProductController::class, 'index']);
Route::post('/', [ProductController::class, 'index']);
Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'index']);

Route::get('product/add', [ProductController::class, 'add']);
Route::post('product/add', [ProductController::class, 'add']);

Route::get('product/edit/{id}', [ProductController::class, 'edit']);
Route::post('product/edit/{id}', [ProductController::class, 'edit']);

Route::get('product/destroy/{id}', [ProductController::class, 'destroy']);
// Route::post('destroy', [ProductController::class, 'destroy']);