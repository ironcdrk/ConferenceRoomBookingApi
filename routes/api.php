<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', ...);
    Route::post('login', ...);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', ...);
        Route::get('me', ...);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('rooms', ...);
    Route::apiResource('bookings', ...);
});

