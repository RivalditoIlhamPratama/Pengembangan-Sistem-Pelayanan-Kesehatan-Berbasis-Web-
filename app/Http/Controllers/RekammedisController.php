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
            'noRm' => 'required|string',
            'NIK' => 'required|string',
            'tanggalPeriksa' => 'required|date',
            'tekananDarah' => 'required|string',
            'RR' => 'required|string',
            'nadi' => 'required|string',
            'suhu' => 'required|string',
            'tinggiBadan' => 'required|string',
            'beratBadan' => 'required|string',
            'diagnosaMedis' => 'required|string',
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
            'tanggalPeriksa' => $validated['tanggalPeriksa'],
            'tekananDarah' => $validated['tekananDarah'],
            'rr' => $validated['RR'],
            'nadi' => $validated['nadi'],
            'suhu' => $validated['suhu'],
            'tinggiBadan' => $validated['tinggiBadan'],
            'beratBadan' => $validated['beratBadan'],
            'diagnosaMedis' => $validated['diagnosaMedis'],
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
        'noRm' => 'required|string',
        'NIK' => 'required|string',
        'tanggalPeriksa' => 'required|date',
        'tekananDarah' => 'required|string',
        'RR' => 'required|string',
        'nadi' => 'required|string',
        'suhu' => 'required|string',
        'tinggiBadan' => 'required|string',
        'beratBadan' => 'required|string',
        'diagnosaMedis' => 'required|string',
        ]);

        $rekammedis = rekammedis::findOrFail($id);
        $rekammedis->update($validated);

        return redirect()->route('dokter.rekam_medis')->with('success', 'Rekam medis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rekammedis = rekammedis::findOrFail($id);
        $rekammedis->delete();

        return redirect()->route('dokter.rekam_medis')->with('success', 'Rekam medis berhasil dihapus!');
    }
}
