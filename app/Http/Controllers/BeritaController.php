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
        try {
            $berita = berita::findOrFail($id);

            $validatedData = $request->validate([
                'judulBerita' => 'required|string',
                'isiBerita' => 'required|string',
                'tanggalBerita' => 'required|date',
            ]);

            $berita->judulBerita = $validatedData['judulBerita'];
            $berita->isiBerita = $validatedData['isiBerita'];
            $berita->tanggalBerita = $validatedData['tanggalBerita'];

            $berita->save();

            Log::info('Berita updated successfully', ['berita_id' => $berita->idBerita]);

            return redirect()->route('admin.berita')->with('success', 'Data berita berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating berita: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data berita.']);
        }
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
