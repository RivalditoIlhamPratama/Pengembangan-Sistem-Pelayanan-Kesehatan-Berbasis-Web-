<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function dashboard()
    {
        return view('dokter.dashboard');
    }
    public function data_dokter() {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.data_dokter', ['dokter' => $dokter]);
    }
    public function rekam_medis() {
        return view('dokter.rekam_medis');
    }
    public function tambah_rekam_medis() {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.tambah_rekam_medis', ['dokter' => $dokter]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();

        $validatedData = $request->validate([
            'namaDokter' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'jenisKelamin' => 'required|string|in:Laki Laki,Perempuan',
            'jadwalPraktek' => 'nullable|string|max:255',
            'noTelepon' => 'nullable|string|max:20',
        ]);

        $dokter->namaDokter = $validatedData['namaDokter'];
        $dokter->spesialis = $validatedData['spesialis'];
        $dokter->jenisKelamin = $validatedData['jenisKelamin'];
        $dokter->jadwalPraktek = $validatedData['jadwalPraktek'] ?? null;
        $dokter->noTelepon = $validatedData['noTelepon'] ?? null;

        $dokter->save();

        return redirect()->route('dokter.data_dokter')->with('success', 'Data dokter berhasil diperbarui.');
    }
}