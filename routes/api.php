<?php

use App\Http\Controllers\Api\Authentication\LoginController;
use App\Http\Controllers\Api\Authentication\LogoutController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::post('/logout', LogoutController::class);
        Route::apiResource('products', ProductController::class);
    });
