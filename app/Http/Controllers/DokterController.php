<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function dashboard()
    {
        return view('dokter.dashboard');
    }
    public function data_dokter() {
        return view('dokter.data_dokter');
    }
    public function rekam_medis() {
        return view('dokter.rekam_medis');
    }
}
