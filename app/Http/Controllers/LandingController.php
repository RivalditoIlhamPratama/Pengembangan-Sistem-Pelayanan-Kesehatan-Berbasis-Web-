<?php

namespace App\Http\Controllers;

use App\Models\berita;

class LandingController extends Controller
{
    public function index()
    {
        $berita = berita::latest()->take(50)->get(); // ambil 6 berita terbaru
        return view('index', compact('berita'));
    }
}
