<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create specific test users
        User::create([
            'username' => 'test',
            'password' => Hash::make('test123'),
            'role' => 'admin'
        ]);

        // Create 10 random users
        User::factory()->count(10)->create();
    }
}