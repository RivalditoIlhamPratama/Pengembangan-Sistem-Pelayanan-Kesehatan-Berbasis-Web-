<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Klinik;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_user_admin()
    {
        $response = $this->post(route('admin.pengguna.store'), [
            'name' => 'Admin Test',
            'username' => 'admintest',
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => 'admintest',
            'role' => 'admin',
            'email' => 'admin@test.com',
        ]);
    }

    public function test_store_user_dokter()
    {
        $klinikUser = \App\Models\User::factory()->create(['role' => 'klinik']);
        $klinik = Klinik::factory()->create([
            'user_id' => $klinikUser->id_user,
        ]);

        $response = $this->withSession(['_token' => csrf_token()])->post(route('admin.pengguna.store'), [
            '_token' => csrf_token(),
            'name' => 'Dokter Test',
            'username' => 'doktertest',
            'email' => 'dokter@test.com',
            'role' => 'dokter',
            'klinik_id' => $klinik->idKlinik,
        ], [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        // Debug response content
        file_put_contents('php://stdout', $response->getContent());

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => 'doktertest',
            'role' => 'dokter',
            'email' => 'dokter@test.com',
        ]);
        $this->assertDatabaseHas('dokters', [
            'namaDokter' => 'Dokter Test',
            'Klinik_id' => $klinik->idKlinik,
        ]);
    }

    public function test_store_user_klinik()
    {
        $response = $this->post(route('admin.pengguna.store'), [
            'name' => 'Klinik Test',
            'username' => 'kliniktest',
            'email' => 'klinik@test.com',
            'role' => 'klinik',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'username' => 'kliniktest',
            'role' => 'klinik',
            'email' => 'klinik@test.com',
        ]);

        $user = \App\Models\User::where('username', 'kliniktest')->first();

        $this->assertDatabaseHas('kliniks', [
            'namaKlinik' => 'Klinik Test',
            'user_id' => $user->id_user,
        ]);
    }
}
