<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryFileController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/form/{category_id?}', [CategoryController::class, 'form'])->name('category-form');
Route::post('/category-store', [CategoryController::class, 'store'])->name('category-store');
Route::post('/category-update/{category_id}', [CategoryController::class, 'update'])->name('category-update');
Route::post('/category-delete', [CategoryController::class, 'delete'])->name('category-delete');

Route::get('/category-files', [CategoryFileController::class, 'index'])->name('category-files');
Route::get('/category-file-form', [CategoryFileController::class, 'form'])->name('category-file-form');
Route::post('/category-file-store', [CategoryFileController::class, 'store'])->name('category-file-store');
Route::post('/category-file-update', [CategoryFileController::class, 'update'])->name('category-file-update');
Route::post('/category-file-delete/{category_id}', [CategoryFileController::class, 'delete'])->name('category-file-delete');

