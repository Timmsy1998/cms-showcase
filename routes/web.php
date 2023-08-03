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

// Main Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Article Routes
Route::resource('articles', App\Http\Controllers\ArticleController::class);
Route::get('/articles/search', [App\Http\Controllers\ArticleController::class, 'search'])->name('articles.search');


// Category Routes
Route::resource('categories', App\Http\Controllers\CategoryController::class);

// Tag Routes
Route::resource('tags', App\Http\Controllers\TagController::class);


