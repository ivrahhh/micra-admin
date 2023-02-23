<?php

use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', fn () => inertia('Authentication/Login'))->name('login');
    Route::post('login', LoginController::class)->name('authenticate');
});