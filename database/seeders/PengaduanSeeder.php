<?php

namespace Database\Seeders;

use App\Models\pengaduan;
use App\Models\pasien;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        // Get all patient IDs
        $pasienIds = pasien::pluck('idPasien')->toArray();

        // Create 10 complaints with valid patient IDs
        for ($i = 0; $i < 10; $i++) {
            pengaduan::create([
                'Pasien_id' => $pasienIds[$i % count($pasienIds)] ?? 1,
                'phone' => '08123' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'jenisPengaduan' => ['pelayanan', 'fasilitas', 'dokter'][$i % 3],
                'isiPengaduan' => 'Isi pengaduan contoh ' . ($i + 1),
                'gambarPengaduan' => null
            ]);
        }
    }
}