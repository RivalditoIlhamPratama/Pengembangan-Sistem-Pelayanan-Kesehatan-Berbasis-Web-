<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use App\Models\rekammedis;
use App\Models\dokter;
use App\Models\klinik;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create()
    {
        $kliniks = klinik::all();
        $dokters = dokter::all();

        return view('klinik.tambah_laporan', compact('kliniks', 'dokters'));
    }

    public function index(Request $request)
    {
        $klinikId = $request->query('klinik_id');

        $laporans = laporan::with(['klinik', 'rekam_medis.dokter'])
            ->where('Klinik_id', $klinikId)
            ->orWhereHas('rekam_medis', function ($query) use ($klinikId) {
                $query->where('Klinik_id', $klinikId);
            })
            ->get();

        // Transform the data to include tanggal from laporan created_at and prefer rekammedis.dokter.namaDokter
        $laporansTransformed = $laporans->map(function ($laporan) {
            return [
                'idLaporan' => $laporan->idLaporan,
                'tanggal' => $laporan->created_at ? $laporan->created_at->format('Y-m-d') : null,
                'namaPasien' => $laporan->namaPasien,
                'NIK' => $laporan->NIK,
                'alamatPasien' => $laporan->alamatPasien,
                'diagnosaMedis' => $laporan->diagnosaMedis,
                'namaDokter' => $laporan->rekam_medis && $laporan->rekam_medis->dokter
                    ? $laporan->rekam_medis->dokter->namaDokter
                    : $laporan->namaDokter,
                'namaKlinik' => $laporan->klinik ? $laporan->klinik->namaKlinik : null,
            ];
        });

        return response()->json($laporansTransformed);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Klinik_id' => 'required|exists:kliniks,idKlinik',
            'RekamMedis_id' => 'nullable|exists:rekammedis,idRekamMedis',
            'namaPasien' => 'nullable|string|max:255',
            'namaDokter' => 'nullable|string|max:255',
            'diagnosaMedis' => 'nullable|string|max:255',
            'NIK' => 'nullable|string|max:20',
            'alamatPasien' => 'nullable|string|max:255',
            'tindakan' => 'nullable|string|max:255',
        ]);

        // Verify that the dokter belongs to the klinik if RekamMedis_id is provided
        if (!empty($validatedData['RekamMedis_id'])) {
            $rekammedis = rekammedis::with('dokter')->find($validatedData['RekamMedis_id']);
            if (!$rekammedis || $rekammedis->Klinik_id != $validatedData['Klinik_id']) {
                return redirect()->back()->withErrors(['RekamMedis_id' => 'Rekammedis does not belong to the specified Klinik.'])->withInput();
            }
            if ($rekammedis->dokter && $rekammedis->dokter->Klinik_id != $validatedData['Klinik_id']) {
                return redirect()->back()->withErrors(['Dokter_id' => 'Dokter does not belong to the specified Klinik.'])->withInput();
            }
        }

        $laporan = new laporan();
        $laporan->Klinik_id = $validatedData['Klinik_id'];
        $laporan->RekamMedis_id = $validatedData['RekamMedis_id'] ?? null;
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
        $laporan = \App\Models\Laporan::findOrFail($id);
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
        'deskripsi_tindakan' => 'required|string|max:255', // sekarang wajib diisi
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
