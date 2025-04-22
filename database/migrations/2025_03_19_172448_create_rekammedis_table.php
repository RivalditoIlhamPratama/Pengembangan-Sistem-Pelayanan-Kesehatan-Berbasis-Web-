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
            $table->string('noRm');
            $table->string('namaPasien');
            $table->string('NIK');
            $table->date('tanggalPeriksa');
            $table->string('tekananDarah');
            $table->string('rr');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('tinggiBadan');
            $table->string('beratBadan');
            $table->string('diagnosaMedis');

            $table->foreign('Dokter_id')->references('idDokter')->on('dokters')->onDelete('cascade');
            $table->foreign('StaffRm_id')->references('idStaffRm')->on('staffrekammedis')->onDelete('cascade');
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
