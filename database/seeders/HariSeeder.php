<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hari;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $haris=['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        for ($i = 0; $i <= 6; $i++) {
            $hari = hari::create([
                'idHari' => $i+1,
                'namaHari' => $haris[$i] ,
            ]);
            echo "Created hari: " . $hari->namaHari . "\n";
        }
    }
}