<?php

namespace Database\Seeders;

use App\Models\waktu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuSeeder extends Seeder
{
    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        waktu::create([
            'jamMulai' => '07:30:00',
            'jamSelesai' => '12:00:00'
        ]);

        waktu::create([
            'jamMulai' => '07:30:00',
            'jamSelesai' => '11:00:00'
        ]);
    }
}
