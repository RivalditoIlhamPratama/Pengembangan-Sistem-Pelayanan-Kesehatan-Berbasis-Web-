<?php

namespace App\Http\Controllers;

use App\Models\adminpuskesmas;
use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{
    public function index()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();

        $berita = [];
        if ($admin) {
            $berita = berita::where('admin_id', $admin->idAdmin)->orderBy('tanggalBerita', 'desc')->get();
        }

        return view('admin.data_berita', ['admin' => $admin, 'berita' => $berita]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judulBerita' => 'required|string',
            'isiBerita' => 'required|string',
            'gambarBerita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggalBerita' => 'required|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambarBerita')) {
            $imagePath = $request->file('gambarBerita')->store('berita', 'public');
        }

        $adminPuskesmas = Auth::user()->admin->first();
        if (!$adminPuskesmas) {
            return back()->withErrors(['error' => 'User tidak memiliki data admin puskesmas terkait.']);
        }

        berita::create([
            'admin_id' => $adminPuskesmas->idAdmin,
            'judulBerita' => $validated['judulBerita'],
            'isiBerita' => $validated['isiBerita'],
            'gambarBerita' => $imagePath,
            'tanggalBerita' => $validated['tanggalBerita'],
        ]);

        return redirect('/admin/berita')->with('success', 'Data berita berhasil ditambahkan.');
    }

    public function show($id)
    {
        $berita = berita::findOrFail($id);
        $berita_lain = berita::where('idBerita', '!=', $id)->latest()->take(5)->get();
    
        return view('berita.detail', compact('berita', 'berita_lain'));
    }
    


    public function update(Request $request, $id)
{
    $request->validate([
        'tanggalBerita' => 'required|date',
        'judulBerita' => 'required|string|max:255',
        'isiBerita' => 'required|string',
        'gambarBerita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $berita = Berita::findOrFail($id);
    $berita->tanggalBerita = $request->tanggalBerita;
    $berita->judulBerita = $request->judulBerita;
    $berita->isiBerita = $request->isiBerita;

    // Ganti gambar jika ada upload baru
    if ($request->hasFile('gambarBerita')) {
        // Hapus gambar lama kalau ada
        if ($berita->gambarBerita && Storage::disk('public')->exists($berita->gambarBerita)) {
            Storage::disk('public')->delete($berita->gambarBerita);
        }

        // Simpan gambar baru
        $berita->gambarBerita = $request->file('gambarBerita')->store('berita', 'public');
    }

    $berita->save();

    return redirect()->route('admin.berita')->with('success', 'Berita berhasil diperbarui.');
}


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
    
        if ($berita->gambarBerita) {
            Storage::disk('public')->delete($berita->gambarBerita);
        }
    
        $berita->delete();
    
        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
    

}
