<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ReportController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware(['jwt.cookie', 'auth:api'])->group(function () {
    // Auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Import
    Route::post('/import', [ImportController::class, 'import']);

    // Reports
    Route::prefix('report')->group(function () {
        Route::get('/top-selling', [ReportController::class, 'topSellingPizzas']);
        Route::get('/sales-by-size', [ReportController::class, 'salesBySize']);
        Route::get('/sales-by-day', [ReportController::class, 'salesByDay']);
        Route::get('/sales-by-month', [ReportController::class, 'salesByMonth']);
        Route::get('/sales-by-year', [ReportController::class, 'salesByYear']);
    });
});
