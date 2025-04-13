<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengaduanController;
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

Route::get('/', function () {
    return view('index'); // Akan mencari file index.blade.php di resources/views
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'post'])->name('logout');


Route::get('/profil', function () {
    return view('profil'); // Akan mencari profil.blade.php di resources/views
});

Route::get('/dokter', function () {
    return view('daftardokter'); // Akan menampilkan daftardokter.blade.php
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
    Route::get('/aduan', [PasienController::class, 'reports'])->name('pasien.reports');
    Route::post('/submit-pengaduan', [PengaduanController::class, 'store'])->name('pasien.reports.submit');

});
