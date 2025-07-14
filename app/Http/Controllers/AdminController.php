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
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::count();
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $user_dokter = User::where('role', 'dokter')->count();
        $pengaduan = pengaduan::count();
        $laporan_klinik = laporan::count();
        return view('admin.dashboard', ['user' => $user, 'user_dokter' => $user_dokter, 'pengaduan' => $pengaduan, 'laporan_klinik' => $laporan_klinik, 'admin' => $admin]);
    }

    public function createUserForm()
    {
        session()->forget('success');
        session()->forget('error');

        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $kliniks = klinik::all();
        $hari = Hari::all();
        $waktu = Waktu::all();

        return view('admin.create', [
            'admin' => $admin,
            'kliniks' => $kliniks,
            'hari' => $hari,
            'waktu' => $waktu,
        ]);
    }

    public function users()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
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
            'jamPraktek' => 'required_if:role,dokter|nullable|exists:waktus,idWaktu',
        ];

        if ($request->role === 'klinik') {
            $rules['name'] .= '|unique:kliniks,namaKlinik';
        }

        $request->validate($rules);

        $user = new User();

        if ($request->role === 'klinik') {
            $user->username = Str::slug($request->name);
        } else {
            $user->username = $request->username;
        }

        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt('password');
        $user->save();

        if ($user->role === 'admin') {
            adminpuskesmas::create([
                'user_id' => $user->id_user,
                'namaAdmin' => $request->name,
                'jenisKelamin' => 'Laki-laki',
                'noHp' => '',
                'alamatAdmin' => '',
                'email' => $request->email ?? '',
            ]);
        } elseif ($user->role === 'dokter') {
            $imagePath = null;
            if ($request->hasFile('gambarProfil')) {
                $imagePath = $request->file('gambarProfil')->store('dokter', 'public');
            }

            $dokter = dokter::create([
                'user_id' => $user->id_user,
                'Klinik_id' => $request->klinik_id,
                'namaDokter' => $request->name,
                'spesialis' => $request->input('spesialis', ''),
                'jenisKelamin' => $request->input('jenisKelamin', 'Laki-Laki'),
                'tglLahir' => $request->input('tglLahir', '2002-04-16'),
                'alamatDokter' => $request->input('alamatDokter', ''),
                'noTelepon' => $request->input('noTelepon', ''),
                'gambarProfil' => $imagePath ?? '',
                'email' => $request->email ?? '',
            ]);

            // Save jadwaldokter entries for selected hariPraktek
            if ($request->has('hariPraktek')) {
                foreach ($request->input('hariPraktek') as $hariId) {
                    \App\Models\jadwaldokter::create([
                        'Dokter_id' => $dokter->idDokter,
                        'Hari_id' => $hariId,
                        'Waktu_id' => $request->input('jamPraktek'), // Add waktu_id from request
                    ]);
                }
            }
        } elseif ($user->role === 'klinik') {
            klinik::create([
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

    public function profil()
    {
        $user = auth()->user(); // ambil user yang login

        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil data admin dari tabel adminpuskesmas
        $admin = \App\Models\adminpuskesmas::where('user_id', $user->id_user)->first();

        return view('admin.profil', compact('admin', 'user'));
    }



    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6',
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $admin = adminpuskesmas::where('user_id', $user->id_user)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Data admin tidak ditemukan.');
        }

        // Simpan data ke tabel adminpuskesmas
        $admin->namaAdmin = $request->namaAdmin;
        $admin->jenisKelamin = $request->jenisKelamin;
        $admin->noHp = $request->noHp;
        $admin->alamatAdmin = $request->alamatAdmin;
        $admin->email = $request->email;
        $admin->save();

        // Simpan ke tabel users
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function updateUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id_user',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role' => 'required|string|in:admin,dokter,klinik,pasien,stafrekammedis',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::where('id_user', $request->id)->first();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update nama di tabel relasional berdasarkan role
        switch ($request->role) {
            case 'admin':
                $user->admin()->update(['namaAdmin' => $request->name]);
                break;
            case 'dokter':
                $user->dokter()->update(['namaDokter' => $request->name]);
                break;
            case 'klinik':
                $user->klinik()->update(['namaKlinik' => $request->name]);
                break;
            case 'pasien':
                $user->pasien()->update(['namaPasien' => $request->name]);
                break;
            case 'stafrekammedis':
                $user->stafrekammedis()->update(['namaStaff' => $request->name]);
                break;
        }

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
