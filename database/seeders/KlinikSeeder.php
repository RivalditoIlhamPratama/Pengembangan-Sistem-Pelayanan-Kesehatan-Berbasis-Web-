<?php

namespace Database\Seeders;

use App\Models\klinik;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific test users
        $nama = ['Gigi', 'Umum', ' Anak'];
        for ($i = 0; $i < count($nama); $i++) {
            $user = User::create([
                'username' => 'Klinik' . $nama[$i],
                'password' => Hash::make('password'),
                'role' => 'klinik',
                'remember_token' => Str::random(10),
            ]);
            echo "Created klinik: " . $user->username . "\n";

            $klinik = Klinik::create([
                'user_id' => $user->id_user,
                'namaKlinik' => 'Klinik ' . $nama[$i],
                'alamatKlinik' => 'Jl. Example No.' . ($i + 1),
                'email' => 'klinik' . $nama[$i] . '@example.com'
            ]);
            echo "Created Klinik: " . $klinik->namaKlinik . "\n";
        }
    }
}
