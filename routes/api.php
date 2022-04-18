<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/authentication', [LoginController::class, 'authenication']);
Route::get('/fail', [LoginController::class, 'fail'])->name('fail');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [LoginController::class, 'profile']);
});

require __DIR__ . '/api/utmleadAdministrator.php';
require __DIR__ . '/api/lecturer.php';
require __DIR__ . '/api/student.php';
