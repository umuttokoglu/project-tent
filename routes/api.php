<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CategoryFileApiController;
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

Route::prefix('v1')->group(function () {
    Route::get('categories', [CategoryApiController::class, 'getCategories']);
    Route::get('category/{id}', [CategoryApiController::class, 'getCategory']);

    Route::get('category-files/{category_id}', [CategoryFileApiController::class, 'getCategoryFiles']);
    Route::get('category-files/{category_id}/{file_id}', [CategoryFileApiController::class, 'getCategoryFile']);
});
