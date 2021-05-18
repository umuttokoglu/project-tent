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
Route::post('/category-store-or-update', [CategoryController::class, 'storeOrUpdate'])->name('category-store-or-update');
Route::post('/category-delete', [CategoryController::class, 'delete'])->name('category-delete');

Route::get('/category-files', [CategoryFileController::class, 'index'])->name('category-files');
Route::get('/category-files/form/{category_file_id?}', [CategoryFileController::class, 'form'])->name('category-file-form');
Route::get('/category-file-download/{category_file_id}', [CategoryFileController::class, 'download'])->name('category-file-download');
Route::post('/category-file-store-or-update', [CategoryFileController::class, 'storeOrUpdate'])->name('category-file-store-or-update');
Route::post('/category-file-delete', [CategoryFileController::class, 'delete'])->name('category-file-delete');

