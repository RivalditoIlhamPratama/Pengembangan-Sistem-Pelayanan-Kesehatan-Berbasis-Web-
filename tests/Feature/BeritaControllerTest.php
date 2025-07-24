<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\adminpuskesmas;
use App\Models\berita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeritaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_berita_success()
    {
        Storage::fake('public');

        // Create user and related adminpuskesmas
        $user = User::factory()->create();
        $admin = adminpuskesmas::factory()->create(['user_id' => $user->id_user]);

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('berita.jpg');

        $response = $this->post(route('admin.berita.store'), [
            'judulBerita' => 'Test Berita',
            'isiBerita' => 'Isi berita test',
            'tanggalBerita' => '2023-01-01',
            'gambarBerita' => $file,
        ]);

        $response->assertRedirect('/admin/berita');
        $response->assertSessionHas('success', 'Data berita berhasil ditambahkan.');

        $this->assertDatabaseHas('beritas', [
            'judulBerita' => 'Test Berita',
            'isiBerita' => 'Isi berita test',
            'tanggalBerita' => '2023-01-01',
            'admin_id' => $admin->idAdmin,
        ]);

        $this->assertTrue(
            Storage::disk('public')->exists('berita/' . $file->hashName()),
            'File does not exist in storage.'
        );
    }

    public function test_store_berita_fails_without_adminpuskesmas()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('admin.berita.store'), [
            'judulBerita' => 'Test Berita',
            'isiBerita' => 'Isi berita test',
            'tanggalBerita' => '2023-01-01',
        ]);

        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('beritas', [
            'judulBerita' => 'Test Berita',
        ]);
    }
}