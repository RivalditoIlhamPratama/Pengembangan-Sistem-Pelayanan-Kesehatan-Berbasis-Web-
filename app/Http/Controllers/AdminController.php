<?php

namespace App\Http\Controllers;

use App\Models\adminpuskesmas;
use App\Models\dokter;
use App\Models\klinik;
use App\Models\pasien;
use App\Models\staffrekammedis;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
    $users = User::with(['admin','stafrekammedis','pasien','klinik', 'dokter'])->get();
    return view('admin.users', compact('users'));
    }

    public function doctors() {
        return view('admin.doctors');
    }

    public function complaints() {
        return view('admin.complaints');
    }

    public function reports() {
        return view('admin.reports');
    }

}
