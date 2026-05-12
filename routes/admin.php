<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ParamController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductParentController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdminMiddleware::class]], function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/params', ParamController::class);
    Route::resource('/categories', CategoryController::class);
    Route::get('/product-parents', [ProductParentController::class, 'index'])->name('product_parents.index ');
});
