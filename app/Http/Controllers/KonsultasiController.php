<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KonsultasiController extends Controller
{
    // Menampilkan halaman chat ke dokter
    public function index($dokterId)
    {
        $chatWith = User::findOrFail($dokterId);

        $messages = Konsultasi::where(function ($q) use ($dokterId) {
            $q->where('from_id', Auth::user()->id_user)
              ->where('to_id', $dokterId);
        })->orWhere(function ($q) use ($dokterId) {
            $q->where('from_id', $dokterId)
              ->where('to_id', Auth::user()->id_user);
        })->orderBy('created_at')->get();

        return view('pasien.konsultasi', [

            'chatWith' => $chatWith,
            'messages' => $messages,
            'namaDokter' => $chatWith->name
        ]);
    }

    // Mengirim pesan baru
    public function kirim(Request $request)
    {
        $request->validate([
            'to_id' => 'required|exists:users,id_user',
            'message' => 'required|string|max:1000',
        ]);

        Konsultasi::create([
            'from_id' => Auth::user()->id_user,
            'to_id' => $request->to_id,
            'pesan' => $request->message,
            'is_read' => false, // <--- tambahkan ini
        ]);
        

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }


    // Data Konsultasi
    public function dataKonsultasi()
    {
        $dokterId = auth()->user()->id_user;
    
        // Ambil pesan terakhir dari tiap pasien
        $pasienList = Konsultasi::select(DB::raw('MAX(id) as id'))
            ->where('to_id', $dokterId)
            ->groupBy('from_id')
            ->pluck('id');
    
        // Ambil data pesan lengkap + relasi pengirim
        $pesanTerakhir = Konsultasi::whereIn('id', $pasienList)
            ->with('pengirim')
            ->orderByDesc('created_at')
            ->get();
        
            $jumlahBelumDibaca = Konsultasi::where('to_id', $dokterId)
    ->where('is_read', false)
    ->groupBy('from_id')
    ->select('from_id', DB::raw('COUNT(*) as jumlah'))
    ->pluck('jumlah', 'from_id'); // hasil: [id_pasien => jumlah]

    
    return view('dokter.datakonsultasi', compact('pesanTerakhir', 'jumlahBelumDibaca'));

    }


    // Chat Pasien
    public function chatPasien($pasienId)
    {
        $dokterId = Auth::user()->id_user;
        $chatWith = User::findOrFail($pasienId);
    
        // Tandai pesan dari pasien sebagai sudah dibaca
        Konsultasi::where('from_id', $pasienId)
            ->where('to_id', $dokterId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    
        $messages = Konsultasi::where(function ($q) use ($pasienId, $dokterId) {
            $q->where('from_id', $pasienId)
            ->where('to_id', $dokterId);
        })->orWhere(function ($q) use ($pasienId, $dokterId) {
            $q->where('from_id', $dokterId)
            ->where('to_id', $pasienId);
        })->orderBy('created_at')->get();
    
        return view('dokter.chat', [
            'chatWith' => $chatWith,
            'messages' => $messages,
            'namaPasien' => $chatWith->name,
        ]);
    }
    


}
