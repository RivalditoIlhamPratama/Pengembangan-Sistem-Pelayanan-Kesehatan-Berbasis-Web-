<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'Klinik_id' => 'required|exists:kliniks,idKlinik',
        'RekamMedis_id' => 'required|exists:rekammedis,idRekamMedis',
    ]);

    $laporan = new \App\Models\laporan();
    $laporan->Klinik_id = $validatedData['Klinik_id'];
    $laporan->RekamMedis_id = $validatedData['RekamMedis_id'];
    $laporan->save();

    return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
}
}