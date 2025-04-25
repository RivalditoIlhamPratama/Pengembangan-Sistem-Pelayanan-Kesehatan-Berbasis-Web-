<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KlinikController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekammedisController;
use App\Http\Controllers\StaffrekammedisController;

// API routes for AdminController
Route::middleware('auth:api')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/data-pengaduan', [AdminController::class, 'data_pengaduan']);
    Route::get('/laporan-klinik', [AdminController::class, 'laporan_klinik']);
    Route::get('/data-dokter', [AdminController::class, 'data_dokter']);
});

// API routes for PasienController
Route::middleware('auth:api')->prefix('pasien')->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard']);
    Route::get('/aduan', [PasienController::class, 'reports']);
    Route::post('/submit-pengaduan', [PengaduanController::class, 'store']);
});

// API routes for KlinikController
Route::middleware('auth:api')->prefix('klinik')->group(function () {
    Route::get('/dashboard', [KlinikController::class, 'dashboard']);
    Route::get('/laporan', [KlinikController::class, 'laporan']);
    Route::get('/laporan/tambah', [KlinikController::class, 'tambah_laporan']);
    Route::post('/laporan/submit', [KlinikController::class, 'store']);
});

// API routes for DokterController
Route::middleware('auth:api')->prefix('dokter')->group(function () {
    Route::get('/dashboard', [DokterController::class, 'dashboard']);
    Route::get('/data_dokter', [DokterController::class, 'data_dokter']);
    Route::post('/data_dokter/store', [DokterController::class, 'store']);
    Route::post('/data_dokter/update', [DokterController::class, 'update']);
    Route::get('/rekam_medis', [DokterController::class, 'rekam_medis']);
    Route::get('/rekam_medis/tambah', [DokterController::class, 'tambah_rekam_medis']);
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store']);
    Route::get('/rekam_medis/edit/{id}', [RekammedisController::class, 'edit']);
    Route::put('/rekam_medis/update/{id}', [RekammedisController::class, 'update']);
    Route::post('/rekam_medis/delete/{id}', [RekammedisController::class, 'destroy']);
});

// API routes for StaffrekammedisController
Route::middleware('auth:api')->prefix('stafrekammedis')->group(function () {
    Route::get('/dashboard', [StaffrekammedisController::class, 'dashboard']);
    Route::get('/rekam_medis/tambah', [StaffrekammedisController::class, 'tambah_rekam_medis']);
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store']);
});