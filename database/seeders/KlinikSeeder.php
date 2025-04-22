<?php

namespace Database\Seeders;

use App\Models\klinik;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific test users
        for ($i = 1; $i <=1; $i++) {
            $user = User::create([
                'username' => 'klinik' . ($i),
                'password' => Hash::make('password'),
                'role' => 'klinik'
            ]);
            echo "Created user: " . $user->username . "\n";

            $klinik = klinik::create([
                'user_id' => $user->id_user,
                'namaKlinik' => 'Klinik ' . $i,
                'alamatKlinik' => 'Jl. Example No.' . $i,
                'email' => 'Klinik' . $i . '@example.com'
            ]);
            echo "Created pasien: " . $klinik->namaKlinik . "\n";
        }
    }
}
