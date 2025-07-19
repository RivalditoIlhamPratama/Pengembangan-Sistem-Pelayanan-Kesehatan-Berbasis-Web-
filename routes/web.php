<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController, RegisterController, LogoutController};
use App\Http\Controllers\{
    AdminController,
    DokterController,
    KlinikController,
    PasienController,
    PengaduanController,
    RekammedisController,
    StaffrekammedisController,
    LandingController,
    BeritaController,
    ChatController,
    LaporanController,
    JadwalDokterController
};

// 🔐 AUTHENTICATION
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [LogoutController::class, 'post'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// 🌐 PUBLIC
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::view('/profil', 'profil');
Route::view('/alur-pelayanan', 'alur_pelayanan')->name('alur.pelayanan');
Route::view('/berita-usg-puskesmas', 'berita_usg_puskesmas')->name('berita.usg');
Route::view('/berita-slb-puskesmas', 'berita_slb_puskesmas')->name('berita.slb');
Route::view('/berita-vaksin-puskesmas', 'berita_vaksin_puskesmas')->name('berita.vaksin');

Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// 🩺 PROFIL DOKTER (statik + dinamis)
Route::get('/dokter', function () {
    $dokter = \App\Models\dokter::all();
    return view('daftardokter', compact('dokter'));
})->name('dokter.index');

Route::get('/dokter/{id}/jadwal', [JadwalDokterController::class, 'show'])->name('jadwal.dokter');

// 👨‍⚕️ DOKTER STATIC PAGES
Route::view('/dokter/siti-jamila', 'siti_jamila')->name('dokter.siti_jamila');
Route::view('/dokter/dwi-wahyudi', 'dwi_wahyudi')->name('dokter.dwi_wahyudi');
Route::view('/dokter/heni-rahmawati', 'heni_rahmawati')->name('dokter.heni_rahmawati');
Route::view('/dokter/fathullah-huda', 'fathullah_huda')->name('dokter.fathullah_huda');

// 👮‍♂️ ADMIN GROUP
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/data-pengaduan', [AdminController::class, 'data_pengaduan'])->name('data_pengaduan');
    Route::delete('/pengaduan/{id}', [AdminController::class, 'destroyPengaduan'])->name('pengaduan.destroy');

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/delete/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/chat/{userId}', [ChatController::class, 'adminChat'])->name('chat');

    Route::get('/profil', [AdminController::class, 'profil'])->name('profil');
    Route::put('/update-profile', [AdminController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/pengguna/create', [AdminController::class, 'createUserForm'])->name('pengguna.create');
    Route::post('/pengguna/store', [AdminController::class, 'storeUser'])->name('pengguna.store');
    Route::put('/pengguna/update', [AdminController::class, 'updateUser'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [AdminController::class, 'destroyUser'])->name('pengguna.destroy');

    Route::get('/data-dokter', [AdminController::class, 'data_dokter'])->name('data_dokter');
    Route::get('/data-dokter/tambah', [AdminController::class, 'tambah_data_dokter'])->name('data_dokter.tambah');
    Route::get('/data-dokter/edit/{id}', [AdminController::class, 'edit_data_dokter'])->name('data_dokter.edit');
    Route::post('/data-dokter/store', [DokterController::class, 'store'])->name('data_dokter.store');
    Route::put('/data-dokter/update/{id}', [DokterController::class, 'update'])->name('data_dokter.update');
    Route::post('/data-dokter/delete/{id}', [DokterController::class, 'destroy'])->name('data_dokter.delete');

    Route::get('/laporan-klinik', [AdminController::class, 'reports'])->name('reports');
});

// 👩‍⚕️ PASIEN
Route::middleware(['auth', 'pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('dashboard');
    Route::get('/aduan', [PasienController::class, 'reports'])->name('reports');
    Route::post('/submit-pengaduan', [PengaduanController::class, 'store'])->name('reports.submit');
});

// 👨‍⚕️ DOKTER
Route::middleware(['auth', 'dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');
    Route::get('/data_dokter', [DokterController::class, 'data_dokter'])->name('data_dokter');
    Route::post('/data_dokter/update', [DokterController::class, 'updateProfilDokter'])->name('data_dokter.update');

    Route::get('/rekam_medis', [DokterController::class, 'rekam_medis'])->name('rekam_medis');
    Route::get('/rekam_medis/tambah', [DokterController::class, 'tambah_rekam_medis'])->name('tambah_rekam_medis');
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store'])->name('rekam_medis.submit');
    Route::get('/rekam_medis/edit/{id}', [RekammedisController::class, 'edit'])->name('rekam_medis.edit');
    Route::put('/rekam_medis/update/{id}', [RekammedisController::class, 'update'])->name('rekam_medis.update');
    Route::post('/rekam_medis/delete/{id}', [RekammedisController::class, 'destroy'])->name('rekam_medis.delete');
});

// 🧾 STAFF REKAM MEDIS
Route::middleware(['auth', 'stafrekammedis'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffrekammedisController::class, 'dashboard'])->name('dashboard');
    Route::get('/data_staffrm', [StaffrekammedisController::class, 'editProfil'])->name('data_staffrm');
    Route::post('/update_profil', [StaffrekammedisController::class, 'updateProfil'])->name('update_profil');
    Route::get('/rekam_medis/tambah', [StaffrekammedisController::class, 'tambah_rekam_medis'])->name('tambah_rekam_medis');
    Route::post('/rekam_medis/submit', [RekammedisController::class, 'store'])->name('rekam_medis.submit');
});

// 🏥 KLINIK
Route::middleware(['auth', 'klinik'])->prefix('klinik')->name('klinik.')->group(function () {
    Route::get('/dashboard', [KlinikController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [KlinikController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/tambah', [KlinikController::class, 'tambah_laporan'])->name('laporan.tambah');
    Route::post('/laporan/submit', [LaporanController::class, 'store'])->name('laporan.submit');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.hapus');
    Route::get('/laporan/edit/{id}', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::get('/profil', [KlinikController::class, 'profil'])->name('profil');
    Route::post('/update_profil', [KlinikController::class, 'updateProfilKlinik'])->name('update_profil');
});

// 💬 CHAT
Route::middleware(['auth'])->prefix('chat')->name('chat.')->group(function () {
    Route::get('/{userId}', [ChatController::class, 'chatPage'])->name('page');
    Route::post('/send', [ChatController::class, 'store'])->name('send');
    Route::get('/fetch/{userId}', [ChatController::class, 'fetch'])->name('fetch');
});

// 📤 EXPORT
Route::get('/export-excel', [LaporanController::class, 'exportExcel']);
