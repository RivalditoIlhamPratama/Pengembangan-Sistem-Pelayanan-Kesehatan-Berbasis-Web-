<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use App\Models\berita;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function dashboard()
    {
        $berita = berita::latest()->take(3)->get(); // Ambil 3 berita terbaru
        return view('pasien.pasien', compact('berita'));
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
