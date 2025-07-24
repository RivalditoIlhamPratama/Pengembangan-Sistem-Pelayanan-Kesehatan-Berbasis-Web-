<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\adminpuskesmas>
 */
class AdminpuskesmasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namaAdmin' => $this->faker->name(),
            'noHp' => $this->faker->phoneNumber(),
            'alamatAdmin' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'user_id' => 1, // This can be overridden in tests
        ];
    }
}
