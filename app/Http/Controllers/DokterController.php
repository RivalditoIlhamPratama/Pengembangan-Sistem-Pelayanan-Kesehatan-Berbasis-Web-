<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Hari;
use App\Models\Rekammedis;
use App\Models\User;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.dashboard', ['dokter' => $dokter]);
    }
    public function data_dokter()
    {
        $user = auth()->user();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.data_dokter', ['dokter' => $dokter, 'waktu' => $waktu, 'hari' => $hari]);
    }
    public function rekam_medis()
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        $rekammedis = Rekammedis::with(['dokter', 'staffrekammedis'])
            ->where('dokter_id', $dokter->idDokter)
            ->get();
        return view('dokter.rekam_medis', ['rekammedis' => $rekammedis, 'dokter' => $dokter]);
    }

    public function tambah_rekam_medis()
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.tambah_rekam_medis', ['dokter' => $dokter]);
    }

    public function store(Request $request)
    {
        Log::info('Store method called in DokterController');
        try {
            $validated = $request->validate([
                'namaDokter' => 'required|string|max:255',
                'spesialis' => 'required|string|max:255',
                'jenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
                'tglLahir' => 'nullable|string|max:255',
                'hariPraktek' => 'required|array',
                'hariPraktek.*' => 'integer',
                'jamPraktek' => 'required|integer',
                'alamatDokter' => 'nullable|string|max:255',
                'noTelepon' => 'nullable|string|max:20',
                'gambarProfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('gambarProfil')) {
                $imagePath = $request->file('gambarProfil')->store('dokter', 'public');
            }

            $user = User::create([
                'username' => $validated['namaDokter'],
                'password' => Hash::make('password'),
                'role' => 'dokter',
                'remember_token' => Str::random(10),
            ]);

            // Get Waktu name for jadwalPraktek string (using first hariPraktek)
            $hari = \App\Models\Hari::find($validated['hariPraktek'][0] ?? null);
            $waktu = \App\Models\Waktu::find($validated['jamPraktek']);
            $jadwalPraktek = ($hari ? $hari->namaHari : '') . ' ' . ($waktu ? $waktu->jamMulai . ' - ' . $waktu->jamSelesai : '');

            $dokter = Dokter::create([
                'user_id' => $user->id_user,
                'namaDokter' =>  $validated['namaDokter'],
                'spesialis'  => $validated['spesialis'],
                'jenisKelamin' => $validated['jenisKelamin'],
                'tglLahir' => $validated['tglLahir'],
                'jadwalPraktek' => $jadwalPraktek,
                'alamatDokter' => $validated['alamatDokter'],
                'noTelepon' => $validated['noTelepon'],
                'gambarProfil' => $imagePath
            ]);

            // Save jadwal dokter for each selected hariPraktek
            foreach ($validated['hariPraktek'] as $hariId) {
                $dokter->jadwaldokters()->create([
                    'Hari_id' => $hariId,
                    'Waktu_id' => $validated['jamPraktek'],
                ]);
            }

            Log::info('Dokter created successfully', ['dokter_id' => $dokter->idDokter]);

            return redirect()->route('admin.data_dokter')->with('success', 'Data dokter berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error in DokterController@store: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data dokter.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dokter = Dokter::findOrFail($id);

            $validatedData = $request->validate([
                'namaDokter' => 'required|string|max:255',
                'spesialis' => 'required|string|max:255',
                'tglLahir' => 'nullable|string|max:255',
                'jenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
                'hariPraktek' => 'required|array',
                'hariPraktek.*' => 'integer',
                'jamPraktek' => 'required|integer',
                'alamatDokter' => 'nullable|string|max:255',
                'noTelepon' => 'nullable|string|max:20',
                'gambarProfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $dokter->namaDokter = $validatedData['namaDokter'];
            $dokter->spesialis = $validatedData['spesialis'];
            $dokter->jenisKelamin = $validatedData['jenisKelamin'];
            $dokter->tglLahir = $validatedData['tglLahir'];
            $dokter->alamatDokter = $validatedData['alamatDokter'];

            // Handle gambarProfil update
            if ($request->hasFile('gambarProfil')) {
                // Delete old image if exists
                if ($dokter->gambarProfil && Storage::disk('public')->exists($dokter->gambarProfil)) {
                    Storage::disk('public')->delete($dokter->gambarProfil);
                }
                // Store new image
                $imagePath = $request->file('gambarProfil')->store('dokter', 'public');
                $dokter->gambarProfil = $imagePath;
            }

            // Get Waktu name for jadwalPraktek string (using first hariPraktek)
            $hari = \App\Models\Hari::find($validatedData['hariPraktek'][0] ?? null);
            $waktu = \App\Models\Waktu::find($validatedData['jamPraktek']);
            $jadwalPraktek = ($hari ? $hari->namaHari : '') . ' ' . ($waktu ? $waktu->jamMulai . ' - ' . $waktu->jamSelesai : '');

            $dokter->noTelepon = $validatedData['noTelepon'] ?? null;

            $dokter->save();

            Log::info('Dokter updated successfully', ['dokter_id' => $dokter->idDokter]);

            // Update jadwaldokters relationship
            // Delete existing jadwaldokters
            $dokter->jadwaldokters()->delete();

            // Create new jadwaldokters for each selected hariPraktek
            foreach ($validatedData['hariPraktek'] as $hariId) {
                $dokter->jadwaldokters()->create([
                    'Hari_id' => $hariId,
                    'Waktu_id' => $validatedData['jamPraktek'],
                ]);
            }

            return redirect()->route('admin.data_dokter')->with('success', 'Data dokter berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating dokter: ' . $e->getMessage() . "\n" . $e->getTraceAsString());


            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data dokter.']);
        }
    }

    public function destroy($id)
    {
        $dokter = dokter::findOrFail($id);

        // Delete gambarProfil image from storage if exists
        if ($dokter->gambarProfil && Storage::disk('public')->exists($dokter->gambarProfil)) {
            Storage::disk('public')->delete($dokter->gambarProfil);
        }

        $dokter->delete();

        return redirect()->route('admin.data_dokter')->with('success', 'Data dokter berhasil dihapus!');
    }
}