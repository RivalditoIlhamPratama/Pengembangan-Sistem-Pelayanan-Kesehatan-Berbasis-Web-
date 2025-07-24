<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'namaDokter' => $this->faker->name(),
            'spesialis' => $this->faker->randomElement(['Umum', 'Gigi', 'Anak']),
            'jenisKelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'tglLahir' => $this->faker->date(),
            'alamatDokter' => $this->faker->address(),
            'noTelepon' => $this->faker->phoneNumber(),
        ];
    }
}