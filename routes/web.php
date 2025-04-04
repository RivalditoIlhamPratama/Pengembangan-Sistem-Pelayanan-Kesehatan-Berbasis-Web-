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

Route::get('/', function () {
    return view('index'); // Akan mencari file index.blade.php di resources/views
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

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





Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');  // Route untuk halaman data pengguna
});