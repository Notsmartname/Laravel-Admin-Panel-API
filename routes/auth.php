<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::group(['prefix' => 'login', 'controller' => AuthenticatedSessionController::class], function () {
        Route::get('/', 'create')->name('login');
        Route::post('/', 'store');
    });

    Route::group(['prefix' => 'reset-password', 'controller' => NewPasswordController::class], function () {
        Route::get('/{token}', 'create')->name('password.reset');
        Route::post('/', 'store')->name('password.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
