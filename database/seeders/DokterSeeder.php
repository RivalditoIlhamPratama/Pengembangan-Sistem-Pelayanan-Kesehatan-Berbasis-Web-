<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create specific test users
        $nama = ['Siti Jamila, Amd. Keb', 'drg. Dwi Wahyudi', ' dr. Heni Rahmawati', ' dr. Fathullah Huda'];
        for ($i = 0; $i < count($nama); $i++) {
            $user = User::create([
                'username' => $nama[$i],
                'password' => Hash::make('password'),
                'role' => 'dokter',
                'remember_token' => Str::random(10),
            ]);
            echo "Created user: " . $user->username . "\n";

            $dokter = Dokter::create([
                'user_id' => $user->id_user,
                'Klinik_id' => '1',
                'namaDokter' => $nama[$i],
                'spesialis' => 'Spesialis',
                'jenisKelamin' => ($i + 1) % 2 ? 'Laki-laki' : 'Perempuan',
                'tglLahir' => '2002-04-16',
                'alamatDokter' => 'Jl. Example No.' . ($i + 1),
                'noTelepon' => '0812345678' . $i,
                'email' => 'dokter ' . $nama[$i] . '@example.com'
            ]);
            echo "Created dokter: " . $dokter->namaDokter . "\n";
        }
    }
}
