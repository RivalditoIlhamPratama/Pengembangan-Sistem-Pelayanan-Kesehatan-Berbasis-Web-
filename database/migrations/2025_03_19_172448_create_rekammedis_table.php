<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekammedis', function (Blueprint $table) {
            $table->id('idRekamMedis');
            $table->unsignedBigInteger('Dokter_id')->nullable();
            $table->unsignedBigInteger('StaffRm_id')->nullable();
            $table->unsignedBigInteger('Klinik_id');
            $table->string('noRm');
            $table->string('namaPasien');
            $table->string('alamatPasien');
            $table->enum('jenisKelamin', ['Laki laki', 'Perempuan']);
            $table->string('usiaPasien');
            $table->enum('agamaPasien', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('statusNikah', ['Belum Kawin', 'Kawin Tercatat', 'Kawin Belum Tercatat', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('NIK');
            $table->date('tanggalPeriksa');
            $table->string('tekananDarah');
            $table->string('rr');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('tinggiBadan');
            $table->string('beratBadan');
            $table->string('riwayatPenyakit');
            $table->string('diagnosaMedis');
            $table->string('tindakan');
            $table->string('resepObat');
            $table->string('rujukan');
            $table->string('alasanRujukan')->nullable();

            $table->foreign('Dokter_id')->references('idDokter')->on('dokters')->onDelete('cascade');
            $table->foreign('StaffRm_id')->references('idStaffRm')->on('staffrekammedis')->onDelete('cascade');
            $table->foreign('Klinik_id')->references('idKlinik')->on('kliniks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekammedis');
    }
};
