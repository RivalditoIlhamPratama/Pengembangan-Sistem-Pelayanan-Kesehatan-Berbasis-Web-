<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use App\Models\rekammedis;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RekammedisController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaPasien' => 'required|string',
            'alamatPasien' => 'required|string',
            'jenisKelamin' => 'required|string|in:Laki laki,Perempuan',
            'usiaPasien' => 'required|string',
            'agamaPasien' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'statusNikah' => 'required|string|in:Belum Kawin,Kawin Tercatat,Kawin Belum Tercatat,Cerai Hidup,Cerai Mati',
            'noRm' => 'required|string',
            'NIK' => 'required|string',
            'tanggalPeriksa' => 'required|date',
            'tekananDarah' => 'required|string',
            'RR' => 'required|string',
            'nadi' => 'required|string',
            'suhu' => 'required|string',
            'tinggiBadan' => 'required|string',
            'beratBadan' => 'required|string',
            'riwayatPenyakit' => 'required|string',
            'diagnosaMedis' => 'required|string',
            'tindakan' => 'required|string',
            'resepObat' => 'required|string',
            'rujukan' => 'required|string',
        ]);

        $dokterId = null;
        $staffId = null;
        if (Auth::user()->dokter && Auth::user()->dokter->first()) {
            $dokterId = Auth::user()->dokter->first()->idDokter;
        }elseif (Auth::user()->stafrekammedis && Auth::user()->stafrekammedis->first()){
            $staffId = Auth::user()->stafrekammedis->first()->idStaffRm;
        }

        rekammedis::create([
            'Dokter_id' => $dokterId,
            'StaffRm_id' => $staffId,
            'noRm' => $validated['noRm'],
            'NIK' => $validated['NIK'],
            'namaPasien' => $validated['namaPasien'],
            'alamatPasien' => $validated['alamatPasien'],
            'jenisKelamin' => $validated['jenisKelamin'],
            'usiaPasien' => $validated['usiaPasien'],
            'agamaPasien' => $validated['agamaPasien'],
            'statusNikah' => $validated['statusNikah'],
            'tanggalPeriksa' => $validated['tanggalPeriksa'],
            'tekananDarah' => $validated['tekananDarah'],
            'rr' => $validated['RR'],
            'nadi' => $validated['nadi'],
            'suhu' => $validated['suhu'],
            'tinggiBadan' => $validated['tinggiBadan'],
            'beratBadan' => $validated['beratBadan'],
            'riwayatPenyakit' => $validated['riwayatPenyakit'],
            'diagnosaMedis' => $validated['diagnosaMedis'],
            'tindakan' => $validated['tindakan'],
            'resepObat' => $validated['resepObat'],
            'rujukan' => $validated['rujukan'],
            'alasanRujukan' => $validated['alasanRujukan'] ?? null,
        ]);

        if (Auth::user()->dokter && Auth::user()->dokter->first()) {
            return redirect()->route('dokter.rekam_medis')->with('success', 'Rekam medis berhasil ditambahkan!');
        }
        else{
            return redirect()->route('stafrekammedis.dashboard')->with('success', 'Rekam medis berhasil ditambahkan!');
        }
    }
    public function edit($id)
    {
        $rekammedis = rekammedis::findOrFail($id);
        return view('dokter.edit_rekam_medis', compact('rekammedis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'namaPasien' => 'required|string',
        'alamatPasien' => 'required|string',
        'jenisKelamin' => 'required|string|in:Laki laki,Perempuan',
        'usiaPasien' => 'required|string',
        'agamaPasien' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'statusNikah' => 'required|string|in:Belum Kawin,Kawin Tercatat,Kawin Belum Tercatat,Cerai Hidup,Cerai Mati',
        'noRm' => 'required|string',
        'NIK' => 'required|string',
        'tanggalPeriksa' => 'required|date',
        'tekananDarah' => 'required|string',
        'RR' => 'required|string',
        'nadi' => 'required|string',
        'suhu' => 'required|string',
        'tinggiBadan' => 'required|string',
        'beratBadan' => 'required|string',
        'riwayatPenyakit' => 'required|string',
        'diagnosaMedis' => 'required|string',
        'tindakan' => 'required|string',
        'resepObat' => 'required|string',
        'rujukan' => 'required|string',
        ]);

        $rekammedis = rekammedis::findOrFail($id);
        $rekammedis->update([
            ...$validated,
            'alasanRujukan' => $validated['alasanRujukan'] ?? null,
        ]);

        return redirect()->route('dokter.rekam_medis')->with('success', 'Rekam medis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rekammedis = rekammedis::findOrFail($id);
        $rekammedis->delete();

        return redirect()->route('dokter.rekam_medis')->with('success', 'Rekam medis berhasil dihapus!');
    }
}