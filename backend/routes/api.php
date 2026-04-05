<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ContactController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Categories & Products
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);
Route::post('/checkout', [OrderController::class, 'checkout']);
Route::post('/contacts', [ContactController::class, 'store']);

// Protected User/Admin routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Admin Only Routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'stats']);
        Route::get('/dashboard/revenue-report', [DashboardController::class, 'revenueReport']);

        Route::get('/products', [ProductController::class, 'adminIndex']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus']);
        Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
        Route::post('/orders/{id}', [OrderController::class, 'destroy']); // _method=DELETE spoofing

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::post('/categories/{id}', [CategoryController::class, 'update']); // _method=PUT spoofing
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Contacts Admin
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::get('/contacts/{id}', [ContactController::class, 'show']);
        Route::put('/contacts/{id}', [ContactController::class, 'updateStatus']);
        Route::post('/contacts/{id}', [ContactController::class, 'updateStatus']); // _method=PUT spoofing
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
    });
});
