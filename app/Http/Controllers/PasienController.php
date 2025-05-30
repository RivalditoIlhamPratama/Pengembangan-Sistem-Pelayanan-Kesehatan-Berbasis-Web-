<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function dashboard()
    {
        return view('pasien.pasien');
    }

    public function reports()
    {
        $pengaduan = pengaduan::all();
        $chatWith = User::where('role', 'admin')->first();
        return view('pasien.aduanmasyarakat', [
            'pengaduan' => $pengaduan,
            'chatWith' => $chatWith,
        ]);
    }
}
