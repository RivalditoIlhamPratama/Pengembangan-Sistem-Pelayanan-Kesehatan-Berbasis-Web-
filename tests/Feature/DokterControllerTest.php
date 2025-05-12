<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\dokter;
use App\Models\Hari;
use App\Models\jadwaldokter;
use App\Models\Waktu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DokterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_dokter()
    {
        // Create a user with admin role
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create Hari and Waktu entries for testing
        $hari = Hari::create(['namaHari' => 'Senin']);
        $waktu = Waktu::create(['jamMulai' => '08:00:00', 'jamSelesai' => '12:00:00']);

        $this->actingAs($admin);

        $postData = [
            'namaDokter' => 'Dr. Test',
            'spesialis' => 'Umum',
            'jenisKelamin' => 'Laki-Laki',
            'tglLahir' => '1980-01-01',
            'hariPraktek' => $hari->idHari,
            'jamPraktek' => $waktu->idWaktu,
            'alamatDokter' => 'Jl. Test No. 1',
            'noTelepon' => '08123456789',
        ];

        $response = $this->post(route('admin.data_dokter.store'), $postData);

        $response->assertRedirect(route('admin.data_dokter'));
        $this->assertDatabaseHas('dokters', [
            'namaDokter' => 'Dr. Test',
            'spesialis' => 'Umum',
            'jenisKelamin' => 'Laki-Laki',
            'alamatDokter' => 'Jl. Test No. 1',
            'noTelepon' => '08123456789',
        ]);

        $this->assertDatabaseHas('jadwaldokters', [
            'Dokter_id' => dokter::where('namaDokter', 'Dr. Test')->first()->idDokter,
            'Hari_id' => $hari->idHari,
            'Waktu_id' => $waktu->idWaktu,
        ]);
    }

    public function test_admin_can_update_dokter()
    {
        // Create a user with admin role
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create Hari and Waktu entries for testing
        $hari1 = Hari::create(['namaHari' => 'Senin']);
        $waktu1 = Waktu::create(['jamMulai' => '08:00:00', 'jamSelesai' => '12:00:00']);
        $hari2 = Hari::create(['namaHari' => 'Selasa']);
        $waktu2 = Waktu::create(['jamMulai' => '13:00:00', 'jamSelesai' => '17:00:00']);

        $this->actingAs($admin);

        // Create a dokter record

        $dokter = dokter::create([
            'user_id' => $admin->id_user,
            'namaDokter' => 'Dr. Old',
            'spesialis' => 'Umum',
            'jenisKelamin' => 'Laki-Laki',
            'tglLahir' => '1970-01-01',
            'jadwalPraktek' => $hari1->namaHari . ' ' . $waktu1->jamMulai . ' - ' . $waktu1->jamSelesai,
            'alamatDokter' => 'Jl. Lama No. 1',
            'noTelepon' => '08111111111',
        ]);
        // Create jadwaldokter record
        $dokter->jadwaldokters()->create([
            'Hari_id' => $hari1->idHari,
            'Waktu_id' => $waktu1->idWaktu,
        ]);


        $updateData = [
            'namaDokter' => 'Dr. New',
            'spesialis' => 'Spesialis Baru',
            'jenisKelamin' => 'Perempuan',
            'tglLahir' => '1985-05-05',
            'hariPraktek' => $hari2->idHari,
            'jamPraktek' => $waktu2->idWaktu,
            'alamatDokter' => 'Jl. Baru No. 2',
            'noTelepon' => '08222222222',
        ];

        $response = $this->post(route('admin.data_dokter.update', ['id' => $dokter->idDokter]), $updateData);
        $response->assertRedirect(route('admin.data_dokter'));

        $this->assertDatabaseHas('dokters', [
            'idDokter' => $dokter->idDokter,
            'namaDokter' => 'Dr. New',
            'spesialis' => 'Spesialis Baru',
            'jenisKelamin' => 'Perempuan',
            'alamatDokter' => 'Jl. Baru No. 2',
            'noTelepon' => '08222222222',
        ]);

        $this->assertDatabaseHas('jadwaldokters', [
            'Dokter_id' => $dokter->idDokter,
            'Hari_id' => $hari2->idHari,
            'Waktu_id' => $waktu2->idWaktu,
        ]);
    }
}
