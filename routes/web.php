<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\RekammedisController;
use App\Http\Controllers\StaffrekammedisController;
use App\Models\staffrekammedis;
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

Route::get('/berita-usg-puskesmas', function () {
    return view('berita_usg_puskesmas');
})->name('berita.usg');

Route::get('/dokter', function () {
    return view('daftardokter');
});

Route::get('/alur-pelayanan', function () {
    return view('alur_pelayanan');
})->name('alur.pelayanan');



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
    Route::post('/data_dokter/update', [DokterController::class, 'update'])->name('dokter.data_dokter.update');
    Route::get('/rekam_medis', [DokterController::class, 'rekam_medis'])->name('dokter.rekam_medis');
    Route::get('/rekam_medis/tambah', [DokterController::class, 'tambah_rekam_medis'])->name('dokter.tambah_rekam_medis');
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store'])->name('dokter.rekam_medis.submit');
    Route::get('/rekam_medis/edit/{id}', [RekammedisController::class, 'edit'])->name('dokter.rekam_medis.edit');
    Route::put('/rekam_medis/update/{id}', [RekammedisController::class, 'update'])->name('dokter.rekam_medis.update');
    Route::delete('/rekam_medis/delete/{id}', [RekammedisController::class, 'destroy'])->name('dokter.rekam_medis.delete');

});

Route::middleware(['auth', 'stafrekammedis'])->prefix('stafrekammedis')->group(function () {
    Route::get('/dashboard', [StaffrekammedisController::class, 'dashboard'])->name('stafrekammedis.dashboard');
    // Route::get('/data_dokter', [DokterController::class, 'data_dokter'])->name('dokter.data_dokter');
    // Route::get('/data_dokter/tambah', [DokterController::class, 'store'])->name('dokter.data_dokter.store');
    // Route::post('/data_dokter/update', [DokterController::class, 'update'])->name('dokter.data_dokter.update');
    Route::get('/rekam_medis/tambah', [StaffrekammedisController::class, 'tambah_rekam_medis'])->name('stafrekammedis.tambah_rekam_medis');
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store'])->name('stafrekammedis.rekam_medis.submit');
    // Route::get('/rekam_medis/edit/{id}', [RekammedisController::class, 'edit'])->name('dokter.rekam_medis.edit');
    // Route::put('/rekam_medis/update/{id}', [RekammedisController::class, 'update'])->name('dokter.rekam_medis.update');
    // Route::delete('/rekam_medis/delete/{id}', [RekammedisController::class, 'destroy'])->name('dokter.rekam_medis.delete');
});


// ini Klinik
Route::get('/klinik/dashboard', function () {
    return view('klinik.dashboard');
})->name('klinik.dashboard');

Route::get('/klinik/tambah-laporan', function () {
    return view('klinik.tambah_laporan');
})->name('klinik.tambah_laporan');

// Halaman daftar laporan
Route::get('/klinik/laporan', function () {
    return view('klinik.laporan_klinik');
})->name('klinik.laporan');

// Simulasi proses POST dari form tambah (tanpa database, hanya redirect balik)
Route::post('/klinik/tambah-laporan', function () {
    return redirect()->route('klinik.laporan')->with('success', 'Data berhasil disimpan (dummy).');
})->name('klinik.tambah_laporan.post');







Route::get('/dokter/siti-jamila', function () {
    return view('siti_jamila');
})->name('dokter.siti_jamila');

Route::get('/dokter/heni-rahmawati', function () {
    return view('heni_rahmawati');
})->name('dokter.heni_rahmawati');

Route::get('/dokter/dwi-wahyudi', function () {
    return view('dwi_wahyudi');
})->name('dokter.dwi_wahyudi');

Route::get('/dokter/fathullah-huda', function () {
    return view('fathullah_huda');
})->name('dokter.fathullah_huda');
