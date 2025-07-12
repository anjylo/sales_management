<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::middleware(['jwt.cookie', 'auth:api'])->group(function () {
    Route::get('/user', [\App\Http\Controllers\AuthController::class, 'user']);

    Route::post('/import', [\App\Http\Controllers\ImportController::class, 'import']);
});