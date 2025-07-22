<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use App\Models\rekammedis;
use App\Models\dokter;
use App\Models\klinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function create()
    {
        // Ambil klinik yang sedang login
        $klinik = Klinik::where('user_id', Auth::user()->id_user)->firstOrFail();
        $dokters = Dokter::where('Klinik_id', $klinik->idKlinik)->get();

        return view('klinik.tambah_laporan', compact('klinik', 'dokters'));
    }

    public function index()
    {
        $user = Auth::user();

        $klinik = Klinik::where('user_id', $user->id_user)->first();

        if (!$klinik) {
            return abort(403, 'Klinik tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $laporans = laporan::with(['klinik', 'rekam_medis.dokter'])
            ->where('Klinik_id', $klinik->idKlinik)
            ->orWhereHas('rekam_medis', function ($query) use ($klinik) {
                $query->where('Klinik_id', $klinik->idKlinik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('klinik.laporan_klinik', compact('laporans'));
    }

    public function store(Request $request)
    {
        $klinik = Klinik::where('user_id', Auth::user()->id_user)->firstOrFail();

        $validatedData = $request->validate([
            'namaPasien' => 'nullable|string|max:255',
            'namaDokter' => 'nullable|string|max:255',
            'diagnosaMedis' => 'nullable|string|max:255',
            'NIK' => 'nullable|string|max:20',
            'alamatPasien' => 'nullable|string|max:255',
            'tindakan' => 'nullable|string|max:255',
        ]);



        $laporan = new laporan();
        $laporan->Klinik_id = $klinik->idKlinik;
        $laporan->namaPasien = $validatedData['namaPasien'] ?? null;
        $laporan->namaDokter = $validatedData['namaDokter'] ?? null;
        $laporan->diagnosaMedis = $validatedData['diagnosaMedis'] ?? null;
        $laporan->NIK = $validatedData['NIK'] ?? null;
        $laporan->alamatPasien = $validatedData['alamatPasien'] ?? null;
        $laporan->deskripsi_tindakan = $validatedData['tindakan'] ?? null;
        $laporan->save();

        return redirect()->route('klinik.laporan')->with('success', 'Laporan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $laporan = laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }

    public function edit($id)
    {
        $laporan = laporan::findOrFail($id);
        return view('klinik.laporan_edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaPasien' => 'required|string|max:255',
            'NIK' => 'required|string|max:25',
            'alamatPasien' => 'required|string',
            'diagnosaMedis' => 'required|string',
            'namaDokter' => 'required|string',
            'deskripsi_tindakan' => 'required|string|max:255',
        ]);

        $laporan = laporan::findOrFail($id);
        $laporan->namaPasien = $request->namaPasien;
        $laporan->NIK = $request->NIK;
        $laporan->alamatPasien = $request->alamatPasien;
        $laporan->diagnosaMedis = $request->diagnosaMedis;
        $laporan->namaDokter = $request->namaDokter;
        $laporan->deskripsi_tindakan = $request->deskripsi_tindakan;
        $laporan->save();

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui.');
    }
}
