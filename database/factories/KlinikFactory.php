<?php

namespace Database\Factories;

use App\Models\klinik;
use Illuminate\Database\Eloquent\Factories\Factory;

class KlinikFactory extends Factory
{
    protected $model = klinik::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'klinik'])->id_user,
            'namaKlinik' => $this->faker->company,
            'alamatKlinik' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
