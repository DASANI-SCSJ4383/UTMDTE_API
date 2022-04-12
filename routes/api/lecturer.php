<?php

use App\Http\Controllers\Lecturer\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lecturer\FormController;
use App\Http\Controllers\Lecturer\MainController;

Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    });

    Route::prefix('form')->name('form.')->group(function() {
        Route::get('', [FormController::class, 'setForm'])->name('list');
        Route::get('/{id}', [FormController::class, 'view'])->name('view');
    });

    Route::prefix('course')->name('course.')->group(function() {
        Route::get('', [CourseController::class, 'list'])->name('list');
        Route::get('/{id}', [CourseController::class, 'view'])->name('view');
        Route::patch('/{id}', [CourseController::class, 'setForm'])->name('setForm');
    });
});
