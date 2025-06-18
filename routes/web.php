<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SekolahController;

// Landing page (root URL akan menampilkan landing page)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Halaman WebGIS (menampilkan peta)
Route::get('/webgis', [MapController::class, 'index'])->name('map.view');

// Endpoint data sekolah dalam format GeoJSON
Route::get('/webgis/data', function() {
    // Pastikan ini mengambil data dari tabel 'sekolahs' dengan kolom 'lat' dan 'lng'
    $sekolahs = DB::table('sekolahs')->select('nama', 'jenjang', 'akreditasi', 'foto', 'lat', 'lng')->get();

    $features = $sekolahs->map(function($sekolah) {
        return [
            'type' => 'Feature',
            'properties' => [
                'nama' => $sekolah->nama,
                'jenjang' => $sekolah->jenjang,
                'akreditasi' => $sekolah->akreditasi,
                'foto' => asset('images/' . $sekolah->foto), // Pastikan path foto benar
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [(double)$sekolah->lng, (double)$sekolah->lat], // Urutan Longitude, Latitude
            ],
        ];
    });

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features,
    ]);
})->name('map.data');

// Rute untuk halaman tabel data sekolah (publik)
Route::get('/sekolah/data-tabel', [SekolahController::class, 'index'])->name('sekolah.table');

// --- Rute yang Dilindungi Autentikasi ---
// Ini akan memanggil rute-rute yang didefinisikan di routes/auth.php
// dan rute-rute yang Anda tambahkan sendiri untuk CRUD.
Route::middleware(['auth'])->group(function () {
    // Rute untuk manajemen data sekolah (read/index for CRUD page)
    Route::get('/sekolah/manage', [SekolahController::class, 'manage'])->name('sekolah.manage');

    // Rute untuk CRUD resources (tambah, edit, hapus)
    Route::resource('sekolah', SekolahController::class)->except(['index', 'show', 'manage']);

    // Rute profil pengguna dari Laravel Breeze
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute dashboard default dari Laravel Breeze (biasanya juga ada di routes/auth.php, jadi ini bisa dihapus)
// Jika Anda ingin mengarahkan /dashboard ke tempat lain, biarkan ini atau sesuaikan.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
