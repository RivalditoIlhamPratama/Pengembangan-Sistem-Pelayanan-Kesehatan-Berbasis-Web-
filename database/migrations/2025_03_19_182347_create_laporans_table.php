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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('idLaporan');
            $table->unsignedBigInteger('Klinik_id');
            $table->unsignedBigInteger('RekamMedis_id');

            $table->foreign('Klinik_id')->references('idKlinik')->on('kliniks')->onDelete('cascade');
            $table->foreign('RekamMedis_id')->references('idRekamMedis')->on('rekammedis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};