<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create specific test users
        Dokter::create([
            'namaDokter' => 'Siti Jamila, Amd. Keb',
            'spesialis' => 'KLASTER 2',
            'jenisKelamin' => 'Perempuan',
            'jadwalPraktek' => 'KLASTER 2',
            'tglLahir' => '2002-04-16',
            'alamatDokter' => 'wqwqqwqwq'
        ],
        [
            'namaDokter' => 'drg. Dwi Wahyudi',
            'spesialis' => 'LINTAS KLASTER GIGI',
            'jenisKelamin' => 'Laki-laki',
            'jadwalPraktek' => 'KLASTER 2',
            'tglLahir' => '2002-04-16',
            'alamatDokter' => 'wqwqqwqwq'
        ],
        ['namaDokter' => 'test',
        'spesialis' => 'test123',
        'jenisKelamin' => 'admin',
        'tglLahir' => 'admin',
        'alamatDokter' => 'admin'
        ],
        ['namaDokter' => 'test',
            'spesialis' => 'test123',
            'jenisKelamin' => 'admin',
            'tglLahir' => 'admin',
            'alamatDokter' => 'admin'
        ],
    );
    }
}
