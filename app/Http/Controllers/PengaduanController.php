<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'jenis_pengaduan' => 'required|string',
            'aduan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('pengaduan', 'public');
        }

        pengaduan::create([
            'Pasien_id' => Auth::user()->pasien->idPasien,
            'phone' => $validated['phone'],
            'jenisPengaduan' => $validated['jenis_pengaduan'],
            'isiPengaduan' => $validated['aduan'],
            'gambarPengaduan' => $imagePath
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim!');
    }
}
