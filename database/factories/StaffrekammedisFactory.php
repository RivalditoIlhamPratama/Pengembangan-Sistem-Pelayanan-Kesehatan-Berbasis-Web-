<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\staffrekammedis>
 */
class StaffrekammedisFactory extends Factory
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
            'namaStaff' => $this->faker->name(),
            'jenisKelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'noHp' => $this->faker->phoneNumber(),
            'alamatStaff' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}