<?php

namespace App\Http\Controllers;

use App\Models\klinik;
use App\Models\laporan;
use App\Models\rekammedis;
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
        $laporan = laporan::with('rekam_medis')->get();
        $klinik = Klinik::where('user_id', $user->id_user)->first();
        return view('klinik.laporan_klinik',['klinik' => $klinik,'laporan'=>$laporan]);
    }
    public function tambah_laporan()
    {
        $kliniks = \App\Models\klinik::all();
        $rekammedis = rekammedis::doesntHave('laporan')->get();

        return view('klinik.tambah_laporan', compact('kliniks', 'rekammedis'));
    }
}
