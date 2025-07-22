<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use App\Models\klinik;
use App\Models\laporan;
use App\Models\rekammedis;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KlinikController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $klinik = Klinik::where('user_id', $user->id_user)->first();
        return view('klinik.dashboard', ['klinik' => $klinik]);
    }
    public function laporan()
    {
        $user = auth()->user();
        $klinik = Klinik::where('user_id', $user->id_user)->first();

        $laporan = laporan::where('Klinik_id', $klinik->idKlinik)->paginate(10);

        return view('klinik.laporan_klinik', ['klinik' => $klinik, 'laporan' => $laporan]);
    }
    public function tambah_laporan()
    {
        $user = auth()->user();

        // Since Klinik_id column is removed, fetch dokters differently
        // Assuming dokters are linked to user or other relation, adjust accordingly

        $dokters = dokter::all();

        $klinik = Klinik::where('user_id', $user->id_user)->first();

        return view('klinik.tambah_laporan', [
            'klinik' => $klinik,
            'dokters' => $dokters,
        ]);
    }

    public function profil()
    {
        $user = auth()->user();
        $klinik = Klinik::where('user_id', $user->id_user)->with('user')->first();

        return view('klinik.data_klinik', compact('klinik'));
    }

    public function updateProfilKlinik(Request $request)
    {
        $request->validate([
            'namaKlinik' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamatKlinik' => 'required|string|max:500',
            'password' => 'nullable|min:6',
        ]);

        $klinik = Klinik::where('idKlinik', $request->idKlinik)->firstOrFail();

        $user = User::where('id_user', $klinik->user_id)->first();

        // Update data Klinik
        $klinik->namaKlinik = $request->namaKlinik;
        $klinik->alamatKlinik = $request->alamatKlinik;
        $klinik->email = $request->email;
        $klinik->save();

        // Update data User
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('klinik.profil')->with('success', 'Profil berhasil diperbarui.');
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
