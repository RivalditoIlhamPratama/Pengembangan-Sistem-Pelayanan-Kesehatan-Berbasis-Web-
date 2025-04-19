<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PasienLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pasien_can_login()
    {
        // Create user with patient role
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password123'),
            'role' => 'pasien'
        ]);

        // Create complete patient record
        Pasien::factory()->create([
            'user_id' => $user->id_user,
            'namaPasien' => 'Test Patient',
            'jenisKelamin' => 'Laki-laki',
            'noHp' => '08123456789',
            'alamatPasien' => 'Test Address',
            'email' => 'pasien@example.com'
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'username' => 'testuser',
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
            'username' => 'testuser',
            'password' => bcrypt('password123'),
            'role' => 'pasien'
        ]);

        Pasien::factory()->create([
            'user_id' => $user->id_user,
            'namaPasien' => 'Test Patient',
            'jenisKelamin' => 'Laki-Laki',
            'noHp' => '08123456789',
            'alamatPasien' => 'Test Address',
            'email' => 'pasien@example.com'
        ]);

        // Attempt login with wrong password
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}