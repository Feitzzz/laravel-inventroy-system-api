<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Authentication routes
 Route::post('/register', [AuthController::class , 'register']);
 Route::post('/login', [AuthController::class , 'login']);
