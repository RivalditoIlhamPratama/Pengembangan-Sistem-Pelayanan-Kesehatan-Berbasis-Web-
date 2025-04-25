<?php

namespace Database\Seeders;

use App\Models\adminpuskesmas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class AdminSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 1; $i++) {
            $user = User::create([
                'username' => 'admin' . $i,
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
            echo "Created user: " . $user->username . "\n";

            $pasien = adminpuskesmas::create([
                'user_id' => $user->id_user,
                'namaAdmin' => 'Admin ' . $i,
                'jenisKelamin' => $i  % 2 ? 'Laki-laki' : 'Perempuan',
                'noHp' => '0812345678' . $i,
                'alamatAdmin' => 'Jl. Example No.' . $i,
                'email' => 'patient' . $i . '@example.com'
            ]);
            echo "Created admin: " . $pasien->namaPasien . "\n";
        }

        echo "Created 5 admin records\n";
    }
}
