<?php

namespace App\Http\Controllers;

use App\Models\rekammedis;
use App\Models\staffrekammedis;
use Illuminate\Http\Request;

class StaffrekammedisController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $staff = Staffrekammedis::where('user_id', $user->id_user)->first();
        $rekammedis = Rekammedis::where('StaffRm_id', $staff->idStaffRm)->get();
        return view('staff.rm', ['rekammedis' => $rekammedis]);
    }
    // public function data_dokter() {
    //     $user = auth()->user();
    //     $dokter = Dokter::where('user_id', $user->id_user)->first();
    //     return view('dokter.data_dokter', ['dokter' => $dokter]);
    // }
    // public function rekam_medis() {
    //     $user = Auth::user();
    //     $dokter = Dokter::where('user_id', $user->id_user)->first();
    //     $rekammedis = rekammedis::where('Dokter_id', $dokter->idDokter)->get();
    //     return view('dokter.rekam_medis', ['rekammedis' => $rekammedis]);
    //     }

    public function tambah_rekam_medis() {
        $user = auth()->user();
        $staff = Staffrekammedis::where('user_id', $user->id_user)->first();
        return view('staff.tambah_rekam_medis', ['staff' => $staff]);
    }

    // public function update(Request $request)
    // {
    //     $user = auth()->user();
    //     $dokter = Dokter::where('user_id', $user->id_user)->first();

    //     $validatedData = $request->validate([
    //         'namaDokter' => 'required|string|max:255',
    //         'spesialis' => 'required|string|max:255',
    //         'jenisKelamin' => 'required|string|in:Laki Laki,Perempuan',
    //         'jadwalPraktek' => 'nullable|string|max:255',
    //         'noTelepon' => 'nullable|string|max:20',
    //     ]);

    //     $dokter->namaDokter = $validatedData['namaDokter'];
    //     $dokter->spesialis = $validatedData['spesialis'];
    //     $dokter->jenisKelamin = $validatedData['jenisKelamin'];
    //     $dokter->jadwalPraktek = $validatedData['jadwalPraktek'] ?? null;
    //     $dokter->noTelepon = $validatedData['noTelepon'] ?? null;

    //     $dokter->save();

    //     return redirect()->route('dokter.data_dokter')->with('success', 'Data dokter berhasil diperbarui.');
    // }
}
