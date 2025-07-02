<?php

namespace App\Http\Controllers;

use App\Models\adminpuskesmas;
use App\Models\dokter;
use App\Models\hari;
use App\Models\jadwaldokter;
use App\Models\klinik;
use App\Models\laporan;
use App\Models\pasien;
use App\Models\pengaduan;
use App\Models\staffrekammedis;
use App\Models\User;
use App\Models\waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::count();
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $user_dokter = User::where('role', 'dokter')->count();
        $pengaduan = pengaduan::count();
        return view('admin.dashboard', ['user' => $user, 'user_dokter' => $user_dokter, 'pengaduan' => $pengaduan, 'admin' => $admin]);
    }

    public function createUserForm()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $kliniks = \App\Models\klinik::all();
        return view('admin.create', ['admin' => $admin, 'kliniks' => $kliniks]);
    }

    public function users()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        // Eager load related klinik and dokter with their klinik
        $users = User::with(['admin', 'stafrekammedis', 'pasien', 'klinik', 'dokter.klinik'])->get();
        return view('admin.users', compact('users', 'admin'));
    }

    public function storeUser(Request $request)
    {
        Log::info('storeUser request data: ', $request->all());

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'nullable|email|max:255',
            'role' => 'required|in:admin,dokter,klinik',
            'klinik_id' => 'required_if:role,dokter|nullable|exists:kliniks,idKlinik',
        ];

        if ($request->role === 'klinik') {
            $rules['name'] .= '|unique:kliniks,namaKlinik';
        }

        $request->validate($rules);

        $user = new User();

        if ($request->role === 'klinik') {
            // For klinik, set username as slug of klinik name
            $user->username = Str::slug($request->name);
        } else {
            $user->username = $request->username;
        }

        $user->role = $request->role;
        $user->email = $request->email;
        // Set a default password or generate one, here using 'password' hashed
        $user->password = bcrypt('password');
        $user->save();

        // Create related record based on role
        if ($user->role === 'admin') {
            \App\Models\adminpuskesmas::create([
                'user_id' => $user->id_user,
                'namaAdmin' => $request->name,
                'jenisKelamin' => 'Laki-laki',
                'noHp' => '',
                'alamatAdmin' => '',
                'email' => $request->email ?? '',
            ]);
        } elseif ($user->role === 'dokter') {
            \App\Models\dokter::create([
                'user_id' => $user->id_user,
                'Klinik_id' => $request->klinik_id,
                'namaDokter' => $request->name,
                'spesialis' => '',
                'jenisKelamin' => 'Laki-Laki',
                'tglLahir' => '2002-04-16',
                'alamatDokter' => 'Jl. Example No.',
                'noTelepon' => '',
                'alamatDokter' => '',
                'gambarProfil' => '',
                'email' => $request->email ?? '',
            ]);
        } elseif ($user->role === 'klinik') {
            \App\Models\klinik::create([
                'user_id' => $user->id_user,
                'namaKlinik' => $request->name,
                'alamatKlinik' => '',
                'email' => $request->email ?? '',
            ]);
        }
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil ditambahkan dengan role ' . $user->role);
    }

    public function data_pengaduan()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $pengaduan = Pengaduan::with('pasien')->get();
        return view('admin.data_pengaduan', ['pengaduan' => $pengaduan, 'admin' => $admin]);
    }

    public function data_dokter()
    {
        $user_auth = auth()->user();
        $jadwal = jadwaldokter::all();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $dokter = Dokter::all();
        return view('admin.data_dokter', ['admin' => $admin, 'dokter' => $dokter, 'waktu' => $waktu, 'hari' => $hari, 'jadwal' => $jadwal]);
    }

    public function tambah_data_dokter()
    {
        $user_auth = auth()->user();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        return view('admin.tambah_dokter', ['admin' => $admin, 'waktu' => $waktu, 'hari' => $hari]);
    }

    public function edit_data_dokter($id)
    {
        $user_auth = auth()->user();
        $jadwal = jadwaldokter::all();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $dokter = Dokter::findOrFail($id);
        return view('admin.edit_dokter', ['admin' => $admin, 'waktu' => $waktu, 'hari' => $hari, 'dokter' => $dokter]);
    }

    public function complaints()
    {
        return view('admin.complaints');
    }

    public function reports()
    {
        $user_auth = auth()->user();
        $laporan = laporan::with(['rekam_medis', 'klinik'])->get();
        Log::info('Fetched laporan count: ' . $laporan->count());
        $klinik = Klinik::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        return view('admin.laporan_klinik', ['admin' => $admin, 'laporan' => $laporan, 'klinik' => $klinik]);
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
    



}
