<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\klinik>
 */
class KlinikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namaKlinik' => $this->faker->company(),
            'user_id' => 1,
            'alamatKlinik' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}