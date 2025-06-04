<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    // User authentication routes
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

    // Customer management routes
    Route::post('/create-customer', [CustomerController::class, 'createCustomer']);
    Route::get('/get-customers', [CustomerController::class, 'getCustomers']);
    Route::get('/get-customer/{customer}', [CustomerController::class, 'getCustomer']);
    Route::patch('/update-customer/{customer}', [CustomerController::class, 'updateCustomer']);
    Route::delete('/delete-customer/{customer}', [CustomerController::class, 'deleteCustomer']);

    // Sale management routes
    Route::post('/create-sale', [SaleController::class, 'createSale']);
    Route::get('/get-sales', [SaleController::class, 'getSales']);
    Route::get('/get-sale/{sale}', [SaleController::class, 'getSale']);
});

// Authentication routes(Unprotected)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
