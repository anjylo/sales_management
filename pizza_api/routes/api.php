<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::middleware(['jwt.cookie', 'auth:api'])->group(function () {
    Route::get('/user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::post('/import', [\App\Http\Controllers\ImportController::class, 'import']);

    Route::get('/report/top-selling', [\App\Http\Controllers\ReportController::class, 'topSellingPizzas']);
    Route::get('/report/sales-by-size', [\App\Http\Controllers\ReportController::class, 'salesBySize']);
    Route::get('/report/sales-by-day', [\App\Http\Controllers\ReportController::class, 'salesByDay']);
    Route::get('/report/sales-by-month', [\App\Http\Controllers\ReportController::class, 'salesByMonth']);
    Route::get('/report/sales-by-year', [\App\Http\Controllers\ReportController::class, 'salesByYear']);
});