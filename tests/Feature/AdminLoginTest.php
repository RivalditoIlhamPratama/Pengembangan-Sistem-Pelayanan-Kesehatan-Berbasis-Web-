<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\adminpuskesmas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_login()
    {
        // Create user with admin role
        $user = User::factory()->create([
            'username' => 'adminuser',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        // Create complete adminpuskesmas record
        adminpuskesmas::factory()->create([
            'user_id' => $user->id_user,
            'namaAdmin' => 'Admin Test',
            'jenisKelamin' => 'Laki-laki',
            'noHp' => '08123456789',
            'alamatAdmin' => 'Admin Address',
            'email' => 'admin@example.com'
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'username' => 'adminuser',
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
            'username' => 'adminuser',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        adminpuskesmas::factory()->create([
            'user_id' => $user->id_user,
            'namaAdmin' => 'Admin Test',
            'jenisKelamin' => 'Laki-laki',
            'noHp' => '08123456789',
            'alamatAdmin' => 'Admin Address',
            'email' => 'admin@example.com'
        ]);

        // Attempt login with wrong password
        $response = $this->post('/login', [
            'username' => 'adminuser',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}