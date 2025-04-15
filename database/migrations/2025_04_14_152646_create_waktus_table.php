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
        Schema::create('waktus', function (Blueprint $table) {
            $table->id('idWaktu');
            $table->unsignedBigInteger('dokter_id');
            $table->string('hari');
            $table->time('jamMulai');
            $table->time('jamSelesai');
            $table->timestamps();

            $table->foreign('dokter_id')->references('idDokter')->on('dokters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktus');
    }
};
