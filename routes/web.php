<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers untuk masing-masing role
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
use App\Http\Controllers\Admin\GuruController as AdminGuru;
use App\Http\Controllers\Admin\MataPelajaranController as AdminMapel;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;

use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\NilaiController as GuruNilai;
use App\Http\Controllers\Guru\RekapController as GuruRekap;

use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilai;

use App\Http\Controllers\HomeController;

// ==================== GUEST ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==================== AUTH ROUTES (Breeze) ====================
require __DIR__.'/auth.php';

// ==================== PROFILE ROUTES ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        
        // Kelola Siswa
        Route::resource('siswa', AdminSiswa::class);
        
        // Kelola Guru
        Route::resource('guru', AdminGuru::class);
        
        // Kelola Mata Pelajaran
        Route::resource('mapel', AdminMapel::class);
        
        // Laporan
        Route::get('/laporan', [AdminLaporan::class, 'index'])->name('laporan');
        Route::get('/laporan/cetak-pdf', [AdminLaporan::class, 'cetakPDF'])->name('laporan.pdf');
    });

// ==================== GURU ROUTES ====================
Route::prefix('guru')
    ->middleware(['auth', 'role:guru'])
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');
        
        // Input Nilai
        Route::get('/nilai', [GuruNilai::class, 'index'])->name('nilai.index');
        Route::post('/nilai/store', [GuruNilai::class, 'store'])->name('nilai.store');
        Route::put('/nilai/update/{id}', [GuruNilai::class, 'update'])->name('nilai.update');
        
        // Rekap Nilai
        Route::get('/rekap', [GuruRekap::class, 'index'])->name('rekap');
    });

// ==================== SISWA ROUTES ====================
Route::prefix('siswa')
    ->middleware(['auth', 'role:siswa'])
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
        
        // Lihat Nilai
        Route::get('/nilai-saya', [SiswaNilai::class, 'index'])->name('nilai');
    });