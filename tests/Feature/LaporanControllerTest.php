<?php

namespace Tests\Feature;

use App\Models\klinik;
use App\Models\laporan;
use App\Models\rekammedis;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Staffrekammedis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_laporan_success()
    {
        // Create user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create klinik record
        $klinik = klinik::factory()->create([
            'user_id' => $user->id_user,
        ]);

        // Create dokter record
        $dokter = Dokter::factory()->create([
            'user_id' => $user->id_user,
        ]);

        // Create staffrekammedis record
        $staff = Staffrekammedis::factory()->create();

        // Create rekammedis record with dokter_id and staffrm_id
        $rekammedis = rekammedis::factory()->create([
            'Dokter_id' => $dokter->idDokter,
            'StaffRm_id' => $staff->idStaffRm,
        ]);

        // Prepare post data
        $postData = [
            'Klinik_id' => $klinik->idKlinik,
            'RekamMedis_id' => $rekammedis->idRekamMedis,
        ];

        // Post to store route
        $response = $this->post(route('klinik.laporan.submit'), $postData);

        // Assert redirect back with success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Laporan berhasil disimpan.');

        // Assert laporan is saved in database
        $this->assertDatabaseHas('laporans', [
            'Klinik_id' => $klinik->idKlinik,
            'RekamMedis_id' => $rekammedis->idRekamMedis,
        ]);
    }

    public function test_store_laporan_validation_error()
    {
        // Create user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Post empty data
        $response = $this->post(route('klinik.laporan.submit'), []);

        // Assert validation errors
        $response->assertSessionHasErrors(['Klinik_id', 'RekamMedis_id']);
    }
}