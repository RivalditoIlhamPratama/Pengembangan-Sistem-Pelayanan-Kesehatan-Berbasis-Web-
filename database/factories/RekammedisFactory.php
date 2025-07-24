<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rekammedis>
 */
class RekammedisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'StaffRm_id' => 1,
            'Dokter_id' => 1,
            'noRm' => $this->faker->unique()->randomNumber(6),
            'namaPasien' => $this->faker->name(),
            'alamatPasien' => $this->faker->address(),
            'jenisKelamin' => $this->faker->randomElement(['Laki laki', 'Perempuan']),
            'usiaPasien' => $this->faker->numberBetween(1, 100),
            'agamaPasien' => $this->faker->randomElement(['Islam', 'Kristen','Katolik','Hindu','Buddha','Konghucu']),
            'statusNikah' => $this->faker->randomElement(['Belum Kawin', 'Kawin Tercatat','Kawin Belum Tercatat','Cerai Hidup','Cerai Mati']),
            'NIK' => $this->faker->unique()->numerify('################'),
            'tanggalPeriksa' => $this->faker->date(),
            'tekananDarah' => '120/80',
            'rr' => 20,
            'nadi' => 80,
            'suhu' => 36.5,
            'tinggiBadan' => 170,
            'beratBadan' => 70,
            'riwayatPenyakit' => 'Tidak ada',
            'diagnosaMedis' => 'Sehat',
            'tindakan' => 'Tidak ada',
            'resepObat' => 'Tidak ada',
            'rujukan' => 'Tidak ada',
            'alasanRujukan' => 'Tidak ada',
        ];
    }
}