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
}