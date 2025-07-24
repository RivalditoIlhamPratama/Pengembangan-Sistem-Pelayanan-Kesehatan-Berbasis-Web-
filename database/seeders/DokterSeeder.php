<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Klinik;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch klinik IDs by name
        $klinikGigi = Klinik::where('namaKlinik', 'like', '%gigi%')->first();
        $klinikUmum = Klinik::where('namaKlinik', 'like', '%umum%')->first();
        $klinikAnak = Klinik::where('namaKlinik', 'like', '%anak%')->first();

        $nama = ['Siti Jamila, Amd. Keb', 'drg. Dwi Wahyudi', 'dr. Fathullah Huda'];
        // Removed Klinik_id mapping since column is dropped
        // $klinikMap = [
        //     0 => $klinikAnak ? $klinikAnak->idKlinik : null,       // Siti Jamila : Anak
        //     1 => $klinikGigi ? $klinikGigi->idKlinik : null,       // Dwi Wahyudi : Gigi
        //     2 => $klinikUmum ? $klinikUmum->idKlinik : null,       // Fathullah Huda : Umum
        // ];

        for ($i = 0; $i < count($nama); $i++) {
            $user = User::create([
                'username' => Str::slug($nama[$i]),
                'password' => Hash::make('password'),
                'role' => 'dokter',
                'remember_token' => Str::random(10),
            ]);
            echo "Created user: " . $user->username . "\n";

            $dokter = Dokter::create([
                'user_id' => $user->id_user,
                // Removed Klinik_id since column no longer exists
                // 'Klinik_id' => $klinikMap[$i],
                'namaDokter' => $nama[$i],
                'spesialis' => 'Spesialis',
                'jenisKelamin' => ($i + 1) % 2 ? 'Laki-laki' : 'Perempuan',
                'tglLahir' => '2002-04-16',
                'alamatDokter' => 'Jl. Example No.' . ($i + 1),
                'noTelepon' => '0812345678' . $i,
                'email' => 'dokter' . $i . '@example.com'
            ]);
            echo "Created dokter: " . $dokter->namaDokter . "\n";
        }
    }
}
