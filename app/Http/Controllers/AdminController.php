<?php

namespace App\Http\Controllers;

use App\Models\adminpuskesmas;
use App\Models\dokter;
use App\Models\hari;
use App\Models\jadwaldokter;
use App\Models\klinik;
use App\Models\laporan;
use App\Models\pasien;
use App\Models\pengaduan;
use App\Models\staffrekammedis;
use App\Models\User;
use App\Models\waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::count();
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $user_dokter = User::where('role', 'dokter')->count();
        $pengaduan = pengaduan::count();
        return view('admin.dashboard', ['user' => $user, 'user_dokter' => $user_dokter, 'pengaduan' => $pengaduan,'admin'=>$admin]);
    }

    public function users()
    {
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $users = User::with(['admin','stafrekammedis','pasien','klinik', 'dokter'])->get();
        return view('admin.users',['admin'=>$admin], compact('users'));
    }

    public function data_pengaduan(){
        $user_auth = auth()->user();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $pengaduan = Pengaduan::with('pasien')->get();
        return view('admin.data_pengaduan',['pengaduan' => $pengaduan,'admin'=>$admin]);
    }

    public function data_dokter() {
        $user_auth = auth()->user();
        $jadwal=jadwaldokter::all();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $dokter = Dokter::all();
        return view('admin.data_dokter',['admin'=>$admin,'dokter'=>$dokter,'waktu'=>$waktu, 'hari'=>$hari,'jadwal'=>$jadwal]);
    }

    public function tambah_data_dokter() {
        $user_auth = auth()->user();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        return view('admin.tambah_dokter', ['admin'=>$admin,'waktu'=>$waktu, 'hari'=>$hari]);
    }

    public function edit_data_dokter($id) {
        $user_auth = auth()->user();
        $jadwal=jadwaldokter::all();
        $waktu = Waktu::all();
        $hari = Hari::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        $dokter = Dokter::findOrFail($id);
        return view('admin.edit_dokter', ['admin'=>$admin,'waktu'=>$waktu, 'hari'=>$hari,'dokter'=>$dokter]);
    }

    public function complaints() {
        return view('admin.complaints');
    }

    public function reports() {
        $user_auth = auth()->user();
        $laporan = laporan::with(['rekam_medis', 'klinik'])->get();
        Log::info('Fetched laporan count: ' . $laporan->count());
        $klinik = Klinik::all();
        $admin = Adminpuskesmas::where('user_id', $user_auth->id_user)->first();
        return view('admin.laporan_klinik',['admin'=>$admin,'laporan'=>$laporan,'klinik'=>$klinik]);
    }

}