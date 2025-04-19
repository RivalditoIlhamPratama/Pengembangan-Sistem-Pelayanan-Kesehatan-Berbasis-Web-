<?php

namespace Database\Seeders;

use App\Models\staffrekammedis;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffrekammedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 unique patient users
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'username' => 'staff' . $i,
                'password' => Hash::make('password'),
                'role' => 'stafrekammedis'
            ]);
            echo "Created staff: " . $user->username . "\n";

            $staff = staffrekammedis::create([
                'user_id' => $user->id_user,
                'namaStaff' => 'staff ' . $i,
                'jenisKelamin' => $i  % 2 ? 'Laki-laki' : 'Perempuan',
                'noHp' => '0812345678' . $i,
                'alamatStaff' => 'Jl. Example No.' . $i,
                'email' => 'staff' . $i . '@example.com'
            ]);
            echo "Created pasien: " . $staff->namaStaff . "\n";
        }

        echo "Created 10 patient records\n";
    }
}
