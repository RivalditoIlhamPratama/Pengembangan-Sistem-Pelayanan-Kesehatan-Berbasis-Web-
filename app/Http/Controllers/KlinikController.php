<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlinikController extends Controller
{
    public function dashboard()
    {
        return view('klinik.dashboard');
    }
    public function laporan()
    {
        return view('klinik.laporan_klinik');
    }
    public function tambah_laporan()
    {
        return view('klinik.tambah_laporan');
    }
}
