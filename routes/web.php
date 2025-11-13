<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pendaftaran\DashboardController as PendaftaranDashboardController;
use App\Http\Controllers\Pendaftaran\PasienController;
use App\Http\Controllers\Pendaftaran\KunjunganController as PendaftaranKunjunganController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use App\Http\Controllers\Apotek\DashboardController as ApotekDashboardController;
use App\Http\Controllers\Apotek\ObatController;
use App\Http\Controllers\Apotek\ResepController;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Redirect based on role
    $role = auth()->user()->role;
    return redirect()->route($role . '.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pendaftaran Routes
Route::middleware(['auth', 'role:pendaftaran'])->prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/dashboard', [PendaftaranDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pasien', PasienController::class);
    Route::get('/kunjungan/create', [PendaftaranKunjunganController::class, 'create'])->name('kunjungan.create');
    Route::post('/kunjungan', [PendaftaranKunjunganController::class, 'store'])->name('kunjungan.store');
});

// Dokter Routes
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pemeriksaan/{kunjungan}', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
    Route::post('/pemeriksaan/{kunjungan}', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
});

// Apotek Routes
Route::middleware(['auth', 'role:apotek'])->prefix('apotek')->name('apotek.')->group(function () {
    Route::get('/dashboard', [ApotekDashboardController::class, 'index'])->name('dashboard');
    Route::resource('obat', ObatController::class);
    Route::get('/resep/{resep}', [ResepController::class, 'show'])->name('resep.show');
    Route::post('/resep/{resep}/proses', [ResepController::class, 'proses'])->name('resep.proses');
});

// Pimpinan Routes
Route::middleware(['auth', 'role:pimpinan'])->prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
