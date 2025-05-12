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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id('idDokter');
            $table->unsignedBigInteger('user_id');
            $table->string('namaDokter');
            $table->string('spesialis');
            $table->enum('jenisKelamin',['Laki-Laki', 'Perempuan']);
            $table->date('tglLahir');
            $table->string('alamatDokter');
            $table->string('noTelepon');

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};