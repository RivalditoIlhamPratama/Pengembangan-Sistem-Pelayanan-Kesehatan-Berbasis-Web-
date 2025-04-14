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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('idPengaduan');
            $table->unsignedBigInteger('Pasien_id');
            $table->text('phone');
            $table->text('isiPengaduan');
            $table->enum('jenisPengaduan',['pelayanan','fasilitas','dokter']);
            $table->text('gambarPengaduan')->nullable();
            $table->timestamps();

            $table->foreign('Pasien_id')->references('idPasien')->on('pasiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};