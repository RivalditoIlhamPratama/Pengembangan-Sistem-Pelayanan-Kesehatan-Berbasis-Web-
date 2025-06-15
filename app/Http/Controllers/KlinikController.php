<?php

namespace App\Http\Controllers;

use App\Models\dokter;
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
        return view('klinik.dashboard', ['klinik' => $klinik]);
    }
    public function laporan()
    {
        $user = auth()->user();
        $laporan = laporan::with('rekam_medis')->get();
        $klinik = Klinik::where('user_id', $user->id_user)->first();
        return view('klinik.laporan_klinik', ['klinik' => $klinik, 'laporan' => $laporan]);
    }
    public function tambah_laporan()
    {
        $user = auth()->user();
        $rekammedis = rekammedis::doesntHave('laporan')->get();
        $dokters = dokter::where('Klinik_id', $user->klinik->idKlinik)->get();
        $klinik = Klinik::where('user_id', $user->id_user)->first();

        return view('klinik.tambah_laporan', [
            'rekammedis' => $rekammedis,
            'dokters' => $dokters,
            'klinik' => $klinik,
        ]);
    }
}
