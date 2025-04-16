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

    rekammedis::create([
        'Dokter_id' => Auth::user()->dokter->first()->idDokter,
        'noRm' => $validated['noRm'],
        'NIK' => $validated['NIK'],
        'namaPasien' => $validated['namaPasien'],
        'tanggalPeriksa' => $validated['tanggalPeriksa'],
        'tekananDarah' => $validated['tekananDarah'],
        'RR' => $validated['RR'],
        'nadi' => $validated['nadi'],
        'suhu' => $validated['suhu'],
        'tinggiBadan' => $validated['tinggiBadan'],
        'beratBadan' => $validated['beratBadan'],
        'diagnosaMedis' => $validated['diagnosaMedis'],
    ]);

    return back()->with('success', 'Rekam medis berhasil disimpan!');
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
'alamatPasien' => 'required|string',
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
