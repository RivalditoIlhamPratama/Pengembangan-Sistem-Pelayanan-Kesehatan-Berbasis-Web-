<?php

namespace App\Http\Controllers;

use App\Models\klinik;
use Illuminate\Http\Request;

class KlinikController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $klinik = Klinik::where('user_id', $user->id_user)->first();
        return view('klinik.dashboard',['klinik' => $klinik]);
    }
    public function laporan()
    {
        $user = auth()->user();
        $klinik = Klinik::where('user_id', $user->id_user)->first();
        return view('klinik.laporan_klinik',['klinik' => $klinik]);
    }
    public function tambah_laporan()
{
    $kliniks = \App\Models\klinik::all();
    $rekammedis = \App\Models\rekammedis::with('dokter')->get();

    return view('klinik.tambah_laporan', compact('kliniks', 'rekammedis'));
}
}
