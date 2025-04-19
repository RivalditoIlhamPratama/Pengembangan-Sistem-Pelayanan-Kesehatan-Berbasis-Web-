<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\dokter;
use App\Models\User;

class DokterLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_dokter_can_login()
    {
        $user = User::factory()->create([
            'username' => 'dokteruser',
            'password' => bcrypt('password'),
            'role' => 'dokter',
        ]);

        $dokter = dokter::factory()->create([
            'user_id' => $user->id_user,
            'namaDokter' => 'Dr. Test',
            'spesialis' => 'General',
            'jenisKelamin' => 'Laki-Laki',
            'tglLahir' => '1980-01-01',
            'alamatDokter' => 'Test Address',
        ]);

        $response = $this->post(route('login.post'), [
            'username' => 'dokteruser',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dokter/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}