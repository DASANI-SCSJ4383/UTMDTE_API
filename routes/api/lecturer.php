<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lecturer\MainController;
use App\Http\Controllers\Lecturer\LoginController;

Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    });
});
