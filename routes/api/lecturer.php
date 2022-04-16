<?php

use App\Http\Controllers\Lecturer\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lecturer\FormController;
use App\Http\Controllers\Lecturer\MainController;

Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

        Route::prefix('form')->name('form.')->group(function () {
            Route::get('/list/{courseID}', [FormController::class, 'list'])->name('list');
            Route::get('/view/{id}', [FormController::class, 'view'])->name('view');
        });

        Route::prefix('course')->name('course.')->group(function () {
            Route::get('', [CourseController::class, 'list'])->name('list');
            Route::get('/{id}', [CourseController::class, 'view'])->name('view');
            Route::patch('/set/{id}', [CourseController::class, 'setForm'])->name('setForm');
            Route::get('/unset/{id}', [CourseController::class, 'unsetForm'])->name('unsetForm');
        });
    });
});
