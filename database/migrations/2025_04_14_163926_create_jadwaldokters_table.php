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
        Schema::create('jadwaldokters', function (Blueprint $table) {
            $table->unsignedBigInteger('Dokter_id');
            $table->unsignedBigInteger('Hari_id');
            $table->unsignedBigInteger('Waktu_id');

            $table->foreign('Dokter_id')->references('idDokter')->on('dokters')->onDelete('cascade');
            $table->foreign('Hari_id')->references('idHari')->on('haris')->onDelete('restrict');
            $table->foreign('Waktu_id')->references('idWaktu')->on('waktus')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwaldokters');
    }
};