<?php

namespace App\Http\Controllers;

use App\Models\adminpuskesmas;
use App\Models\dokter;
use App\Models\klinik;
use App\Models\pasien;
use App\Models\pengaduan;
use App\Models\staffrekammedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::count();
        $user_dokter = User::where('role', 'dokter')->count();
        $pengaduan = pengaduan::count();
        return view('admin.dashboard', ['user' => $user, 'user_dokter' => $user_dokter, 'pengaduan' => $pengaduan]);
    }

    public function users()
    {
    $users = User::with(['admin','stafrekammedis','pasien','klinik', 'dokter'])->get();
    return view('admin.users', compact('users'));
    }

    public function data_pengaduan(){
        $pengaduan = Pengaduan::with('pasien')->get();
        return view('admin.data_pengaduan',['pengaduan' => $pengaduan]);
    }

    public function data_dokter() {
        return view('admin.data_dokter');
    }

    public function complaints() {
        return view('admin.complaints');
    }

    public function reports() {
        return view('admin.reports');
    }

}
