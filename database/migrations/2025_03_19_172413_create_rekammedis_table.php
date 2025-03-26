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
            $table->unsignedBigInteger('idDokter');
            $table->unsignedBigInteger('idStaffRm');
            $table->string('namaPasien');
            $table->string('NIK');
            $table->string('alamatPasien');
            $table->date('tanggalRekamMedis');
            $table->string('tekananDarah');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('suhu');
            $table->string('tinggiBadan');
            $table->string('beratBadan');
            $table->string('diagnosaMedis');
            $table->timestamps();
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
