<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function dashboard()
    {
        return view('pasien.pasien');
    }

    public function reports() {
        return view('pasien.aduanmasyarakat');
    }
}