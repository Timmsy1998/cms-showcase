<?php

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

// Authentication Routes
Auth::routes();

// Home Route

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Article Routes
Route::resource('articles', App\Http\Controllers\ArticleController::class);

// Category Routes
Route::resource('categories', App\Http\Controllers\CategoryController::class);

// Tag Routes
Route::resource('tags', App\Http\Controllers\TagController::class);


