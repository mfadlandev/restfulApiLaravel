<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;


// PUBLIC ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware([
    'auth:sanctum',
    CheckRole::class . ':admin_pusat',
])->group(function () {
    Route::apiResource('outlets', OutletController::class);
});

// PROTECTED ROUTES
Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::get('/user', [AuthController::class, 'profile']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Produk: semua role boleh membaca
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    // Kategori: semua role boleh membaca
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // Admin pusat dan admin outlet
    Route::middleware('role:admin_pusat,admin_outlet')->group(function () {

        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::patch('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::patch('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    });
});
