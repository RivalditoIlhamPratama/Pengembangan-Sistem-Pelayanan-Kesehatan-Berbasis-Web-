<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RekammedisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');




Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'post'])->name('logout');

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/dokter', function () {
    return view('daftardokter');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/data-pengaduan', [AdminController::class, 'data_pengaduan'])->name('admin.data_pengaduan');
    Route::get('/laporan-klinik', [AdminController::class, 'laporan_klinik'])->name('admin.laporan_klinik');
    Route::get('/data-dokter', [AdminController::class, 'data_dokter'])->name('admin.data_dokter');
});

Route::middleware(['auth', 'pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
    Route::get('/aduan', [PasienController::class, 'reports'])->name('pasien.reports');
    Route::post('/submit-pengaduan', [PengaduanController::class, 'store'])->name('pasien.reports.submit');
});

Route::middleware(['auth', 'dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
    Route::get('/data_dokter', [DokterController::class, 'data_dokter'])->name('dokter.data_dokter');
    Route::get('/data_dokter/tambah', [DokterController::class, 'store'])->name('dokter.data_dokter.store');
    Route::get('/rekam_medis', [DokterController::class, 'rekam_medis'])->name('dokter.rekam_medis');
    Route::get('/rekam_medis/tambah', [RekammedisController::class, 'store'])->name('dokter.rekam_medis.submit');
});