<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $roles = ['dokter', 'pasien', 'stafrekammedis', 'admin', 'klinik'];

        return [
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement($roles),
            'remember_token' => Str::random(10),
        ];
    }
}