<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Category management routes
    Route::post('/create-category', [CategoryController::class, 'createCategory']);
    Route::get('/get-categories', [CategoryController::class, 'getCategories']);
    Route::patch('/update-category/{category}', [CategoryController::class, 'updateCategory']);
    Route::delete('/delete-category/{category}', [CategoryController::class, 'deleteCategory']);

    // Product management routes
    Route::post('/create-product', [ProductController::class, 'createProduct']);
    Route::get('/get-product/{product}', [ProductController::class, 'getProduct']);
    Route::patch('/update-product/{product}', [ProductController::class, 'updateProduct']);
    Route::delete('/delete-product/{product}', [ProductController::class, 'deleteProduct']);
});

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
