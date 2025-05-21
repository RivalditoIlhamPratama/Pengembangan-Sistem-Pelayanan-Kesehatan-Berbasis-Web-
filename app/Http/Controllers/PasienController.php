<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function dashboard()
    {
        return view('pasien.pasien');
    }

    public function reports() {
        $pengaduan = pengaduan::all();
        return view('pasien.aduanmasyarakat',['pengaduan' =>$pengaduan]);
    }
}
