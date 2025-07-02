<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dokter;

class JadwaldokterController extends Controller

{
    public function show($id)
    {
        $dokter = dokter::with(['jadwaldokters.hari', 'jadwaldokters.waktu'])->findOrFail($id);
        return view('jadwal.jadwal_dokter', compact('dokter'));
    }

}
