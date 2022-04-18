<?php

use Illuminate\Support\Facades\Route;

Route::prefix('student')->name('student.')->group(function(){
    Route::middleware('auth:api')->group(function(){
        Route::get('/dashboard',[MainController::class, 'dashboard'])->name('dashboard');

        Route::prefix('course')->name('course.')->group(function(){
            Route::get('', [CourseController::class, 'list'])->name('list');
        });

        
    });
});
