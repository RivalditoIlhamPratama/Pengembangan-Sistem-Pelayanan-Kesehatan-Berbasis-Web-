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

class DokterController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.dashboard',['dokter' => $dokter]);
    }
    public function data_dokter() {
        $user = auth()->user();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.data_dokter', ['dokter' => $dokter, 'waktu'=>$waktu, 'hari'=>$hari]);
    }
    public function rekam_medis() {
        $user = auth()->user();
        $rekammedis = rekammedis::with(['dokter', 'staffrekammedis'])->get();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.rekam_medis', ['rekammedis' => $rekammedis, 'dokter' => $dokter]);
    }

    public function tambah_rekam_medis() {
        $user = auth()->user();
        $dokter = Dokter::where('user_id', $user->id_user)->first();
        return view('dokter.tambah_rekam_medis', ['dokter' => $dokter]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaDokter' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'jenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
            'tglLahir' => 'nullable|string|max:255',
            'hariPraktek' => 'required|integer',
            'jamPraktek' => 'required|integer',
            'alamatDokter' => 'nullable|string|max:255',
            'noTelepon' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'username' => $validated['namaDokter'],
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'remember_token' => Str::random(10),
        ]);

        // Get Hari and Waktu names for jadwalPraktek string
        $hari = \App\Models\Hari::find($validated['hariPraktek']);
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
        ]);

        // Save jadwal dokter
        $dokter->jadwaldokters()->create([
            'Hari_id' => $validated['hariPraktek'],
            'Waktu_id' => $validated['jamPraktek'],
        ]);

        return redirect()->route('admin.data_dokter')->with('success', 'Data dokter berhasil ditambahkan.');
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
                'hariPraktek' => 'required|integer',
                'jamPraktek' => 'required|integer',
                'alamatDokter' => 'nullable|string|max:255',
                'noTelepon' => 'nullable|string|max:20',
            ]);

            $dokter->namaDokter = $validatedData['namaDokter'];
            $dokter->spesialis = $validatedData['spesialis'];
            $dokter->jenisKelamin = $validatedData['jenisKelamin'];
            $dokter->tglLahir = $validatedData['tglLahir'];
            $dokter->alamatDokter = $validatedData['alamatDokter'];

            // Get Hari and Waktu names for jadwalPraktek string
            $hari = \App\Models\Hari::find($validatedData['hariPraktek']);
            $waktu = \App\Models\Waktu::find($validatedData['jamPraktek']);
            $jadwalPraktek = ($hari ? $hari->namaHari : '') . ' ' . ($waktu ? $waktu->jamMulai . ' - ' . $waktu->jamSelesai : '');

            $dokter->noTelepon = $validatedData['noTelepon'] ?? null;

            $dokter->save();

            Log::info('Dokter updated successfully', ['dokter_id' => $dokter->idDokter]);

            // Update jadwaldokters relationship
            $jadwal = $dokter->jadwaldokters()->first();
            if ($jadwal) {
                $jadwal->update([
                    'Hari_id' => $validatedData['hariPraktek'],
                    'Waktu_id' => $validatedData['jamPraktek'],
                ]);
            } else {
                $dokter->jadwaldokters()->create([
                    'Hari_id' => $validatedData['hariPraktek'],
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
        $dokter->delete();

        return redirect()->route('admin.data_dokter')->with('success', 'Data dokter berhasil dihapus!');
    }
}