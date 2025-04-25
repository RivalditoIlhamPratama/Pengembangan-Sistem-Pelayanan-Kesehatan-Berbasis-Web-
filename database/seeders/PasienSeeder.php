<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\pasien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasienSeeder extends Seeder
{
    public function run()
    {
        // Create 10 unique patient users
        for ($i = 1; $i <= 2; $i++) {
            $user = User::create([
                'username' => 'pasien' . $i,
                'password' => Hash::make('password'),
                'role' => 'pasien',
                'remember_token' => Str::random(10),
            ]);
            echo "Created user: " . $user->username . "\n";

            $pasien = pasien::create([
                'user_id' => $user->id_user,
                'namaPasien' => 'Patient ' . $i,
                'jenisKelamin' => $i  % 2 ? 'Laki-laki' : 'Perempuan',
                'noHp' => '0812345678' . $i,
                'alamatPasien' => 'Jl. Example No.' . $i,
                'email' => 'patient' . $i . '@example.com'
            ]);
            echo "Created pasien: " . $pasien->namaPasien . "\n";
        }

        echo "Created 10 patient records\n";
    }
}
