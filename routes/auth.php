<?php

use App\Http\Controllers\Authentication\ForgotPasswordController;
use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', fn () => inertia('Authentication/Login'))->name('login');
    Route::post('login', LoginController::class)->name('authenticate');

    Route::get('forgot-password', fn () => inertia('Authentication/ForgotPassword'))->name('password.request');
    Route::post('forgot-password', ForgotPasswordController::class)->name('password.email');
    Route::get('reset-password/{token}')->name('password.reset');
    Route::post('reset-password')->name('password.update');
});