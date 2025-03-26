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
            $table->unsignedBigInteger('id_user');
            $table->string('namaDokter');
            $table->string('spesialis');
            $table->enum('jenisKelamin',['Pria', 'Wanita']);
            $table->string('jadwalPraktek');
            $table->date('tglLahir');
            $table->string('alamatDokter');
            $table->timestamps();
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