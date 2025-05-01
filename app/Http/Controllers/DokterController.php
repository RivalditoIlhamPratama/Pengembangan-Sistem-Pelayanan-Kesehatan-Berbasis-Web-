<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Hari;
use App\Models\Rekammedis;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.dashboard',['dokter' => $dokter]);
    }
    public function data_dokter() {
        $user = auth()->user();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.data_dokter', ['dokter' => $dokter, 'waktu'=>$waktu, 'hari'=>$hari]);
    }
    public function rekam_medis() {
        $user = auth()->user();
        $rekammedis = rekammedis::with(['dokter', 'staffrekammedis'])->get();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.rekam_medis', ['rekammedis' => $rekammedis, 'dokter' => $dokter]);
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
            'hariPraktek' => 'nullable|string|max:255',
            'jamPraktek' => 'nullable|string|max:255',
            'noTelepon' => 'nullable|string|max:20',
        ]);

        $dokter->namaDokter = $validatedData['namaDokter'];
        $dokter->spesialis = $validatedData['spesialis'];
        $dokter->jenisKelamin = $validatedData['jenisKelamin'];

        // Combine hariPraktek and jamPraktek into jadwalPraktek string
        $hari = $validatedData['hariPraktek'] ?? '';
        $jam = $validatedData['jamPraktek'] ?? '';
        $dokter->jadwalPraktek = trim($hari . ' ' . $jam);

        $dokter->noTelepon = $validatedData['noTelepon'] ?? null;

        $dokter->save();

        return redirect()->route('dokter.data_dokter')->with('success', 'Data dokter berhasil diperbarui.');
    }
}
