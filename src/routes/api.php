<?php

use Arealtime\Auth\App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('api/arealtime/auth')
    ->name('arealtime.auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });
