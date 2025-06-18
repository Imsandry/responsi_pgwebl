<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Halaman WebGIS (menampilkan peta)
Route::get('/webgis', [MapController::class, 'index'])->name('map.view');

// Endpoint data sekolah dalam format GeoJSON
Route::get('/webgis/data', [MapController::class, 'data'])->name('map.data');

// (Opsional) Jika kamu pakai Laravel Auth:
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
// Auth::routes(); // Jika pakai Laravel UI atau Breeze

