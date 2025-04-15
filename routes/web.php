<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
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
    return view('index'); // Akan mencari file index.blade.php di resources/views
});

Route::get('/profil', function () {
    return view('profil'); // Akan mencari profil.blade.php di resources/views
});

Route::get('/dokter', function () {
    return view('daftardokter'); // Akan menampilkan daftardokter.blade.php
});


Route::get('/aduanmasyarakat', function () {
    return view('aduanmasyarakat'); // Akan menampilkan aduanmasyarakat.blade.php
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});



// Halaman "admin/"
 
Route::prefix('admin')->group(function () {  // Semua route di dalam group ini akan memiliki prefix "admin/"
    
    // Route untuk halaman Dashboard Admin
    Route::get('/dashboard', function () {   // Menangani permintaan GET ke "admin/dashboard"
        return view('admin.dashboard');      // Menampilkan view "resources/views/admin/dashboard.blade.php"
    })->name('admin.dashboard');             // Memberikan nama "admin.dashboard" untuk route ini
    
    // Route untuk halaman Data Pengguna
    Route::get('/users', function () {       // Menangani permintaan GET ke "admin/users"
        return view('admin.users');          // Menampilkan view "resources/views/admin/users.blade.php"
    })->name('admin.users');                 // Nama route: "admin.users"

    // Route untuk halaman Data Pengaduan
    Route::get('/data-pengaduan', function () {   // Menangani permintaan GET ke "admin/data-pengaduan"
        return view('admin.data_pengaduan');      // Menampilkan view "resources/views/admin/data_pengaduan.blade.php"
    })->name('admin.data_pengaduan');             // Nama route: "admin.data_pengaduan"

    // Route untuk halaman Laporan Klinik
    Route::get('laporan-klinik', function () {   // Menangani permintaan GET ke "admin/laporan-klinik"
        return view('admin.laporan_klinik');     // Menampilkan view "resources/views/admin/laporan_klinik.blade.php"
    })->name('admin.laporan_klinik');            // Nama route: "admin.laporan_klinik"

    // Route untuk halaman Data Dokter
    Route::get('data-dokter', function () {   // Menangani permintaan GET ke "admin/data-dokter"
        return view('admin.data_dokter');     // Menampilkan view "resources/views/admin/data_dokter.blade.php"
    })->name('admin.data_dokter');            // Nama route: "admin.data_dokter"
    
});


// halaman Dokter

Route::prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::get('/data-dokter', function () {
        return view('dokter.data_dokter');
    })->name('dokter.data_dokter');

    Route::prefix('dokter')->group(function () {
        Route::get('/rekam-medis', function () {
            return view('dokter.rekam_medis');
        })->name('dokter.rekam_medis');
    });
    
    Route::prefix('dokter')->group(function () {
    Route::get('/rekam-medis', function () {
        return view('dokter.rekam_medis');
    })->name('dokter.rekam_medis');

    Route::get('/rekam-medis/tambah', function () {
        return view('dokter.tambah_rekam_medis');
    })->name('dokter.tambah_rekam_medis');
});
Route::get('/tambah-dokter', function () {
    return view('dokter.tambah_dokter');
})->name('dokter.tambah_dokter');



});

Route::prefix('staff')->group(function () {
    Route::get('/rekam-medis', function () {
        return view('staff.rm');
    })->name('staff.rm');
});













