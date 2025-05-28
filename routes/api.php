<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/create-category', [CategoryController::class, 'createCategory']);
    Route::patch('/update-category/{category}', [CategoryController::class, 'updateCategory']);
    Route::delete('/delete-category/{category}', [CategoryController::class, 'deleteCategory']);
});

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
