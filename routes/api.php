<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

Route::apiResource('products', App\Http\Controllers\ProductController::class);

Route::apiResource('accessories', App\Http\Controllers\AccessoryController::class);
