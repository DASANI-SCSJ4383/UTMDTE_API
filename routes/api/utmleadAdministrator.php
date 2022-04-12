<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtmleadAdministrator\FormController;
use App\Http\Controllers\UtmleadAdministrator\MainController;
use App\Http\Controllers\UtmleadAdministrator\RubricController;

Route::prefix('utmleadAdministrator')->name('utmleadAdministrator.')->group(function(){
    Route::middleware('auth:api')->group(function(){
        Route::get('/dashboard',[MainController::class, 'dashboard'])->name('dashboard');

        Route::prefix('form')->name('form.')->group(function() {
            Route::get('', [FormController::class, 'list'])->name('list');
            Route::get('/{id}', [FormController::class, 'view'])->name('view');
            Route::post('', [FormController::class, 'create'])->name('create');
            Route::patch('/{id}', [FormController::class, 'update'])->name('update');
            Route::delete('/{id}', [FormController::class, 'delete'])->name('delete');
        });

        Route::prefix('rubric')->name('rubric.')->group(function() {
            Route::get('/list/{formID}', [RubricController::class, 'list'])->name('list');
            Route::get('/view/{id}', [RubricController::class, 'view'])->name('view');
            Route::post('/{formID}', [RubricController::class, 'create'])->name('create');
            Route::patch('/{id}', [RubricController::class, 'update'])->name('update');
            Route::delete('/{id}', [RubricController::class, 'delete'])->name('delete');
        });
    });
});


