<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\dokter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DokterLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dokter_can_login()
    {
        // Create user with dokter role
        $user = User::factory()->create([
            'username' => 'dokteruser',
            'password' => bcrypt('password123'),
            'role' => 'dokter'
        ]);

        // Create complete dokter record
        dokter::factory()->create([
            'user_id' => $user->id_user,
            'namaDokter' => 'Test Dokter',
            'spesialis' => 'Umum',
            'jenisKelamin' => 'Pria',
            'jadwalPraktek' => 'Senin-Jumat',
            'tglLahir' => '1980-01-01',
            'alamatDokter' => 'Test Address'
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'username' => 'dokteruser',
            'password' => 'password123'
        ]);

        // Verify authentication
        $response->assertStatus(302);
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id_user, Auth::id());
    }

    /** @test */
    public function invalid_credentials_fail()
    {
        $user = User::factory()->create([
            'username' => 'dokteruser',
            'password' => bcrypt('password123'),
            'role' => 'dokter'
        ]);

        dokter::factory()->create([
            'user_id' => $user->id_user,
            'namaDokter' => 'Test Dokter',
            'spesialis' => 'Umum',
            'jenisKelamin' => 'Pria',
            'jadwalPraktek' => 'Senin-Jumat',
            'tglLahir' => '1980-01-01',
            'alamatDokter' => 'Test Address'
        ]);

        // Attempt login with wrong password
        $response = $this->post('/login', [
            'username' => 'dokteruser',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}