<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
// ... controller lainnya

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login'); // <-- ini rute 'login'
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    // ... rute lainnya
});

Route::middleware('auth')->group(function () {
    // ... rute yang memerlukan autentikasi
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // <-- ini rute 'logout'
});
