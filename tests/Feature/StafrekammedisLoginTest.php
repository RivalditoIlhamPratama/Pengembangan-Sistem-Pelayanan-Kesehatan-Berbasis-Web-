<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\staffrekammedis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StafrekammedisLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function stafrekammedis_can_login()
    {
        // Create user with stafrekammedis role
        $user = User::factory()->create([
            'username' => 'stafuser',
            'password' => bcrypt('password123'),
            'role' => 'stafrekammedis'
        ]);

        // Create related stafrekammedis record
        staffrekammedis::factory()->create([
            'user_id' => $user->id_user,
            'namaStaff' => 'Test Staff',
            'jenisKelamin' => 'Laki-Laki',
            'noHp' => '08123456789',
            'alamatStaff' => 'Test Address',
            'email' => 'teststaff@example.com',
        ]);

        // Attempt login
        $response = $this->post('/login', [
            'username' => 'stafuser',
            'password' => 'password123'
        ]);

        // Verify authentication and redirection
        $response->assertStatus(302);
        $response->assertRedirect('/stafrekammedis/dashboard');
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id_user, Auth::id());
    }

    /** @test */
    public function invalid_credentials_fail()
    {
        $user = User::factory()->create([
            'username' => 'stafuser',
            'password' => bcrypt('password123'),
            'role' => 'stafrekammedis'
        ]);

        staffrekammedis::factory()->create([
            'user_id' => $user->id_user,
            'namaStaff' => 'Test Staff',
            'jenisKelamin' => 'Laki-Laki',
            'noHp' => '08123456789',
            'alamatStaff' => 'Test Address',
            'email' => 'teststaff@example.com',
        ]);

        // Attempt login with wrong password
        $response = $this->post('/login', [
            'username' => 'stafuser',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }
}