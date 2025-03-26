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
        Schema::create('akunpenggunas', function (Blueprint $table) {
            $table->id('id_user');
            $table->id('username');
            $table->string('password');
            $table->enum('role',['dokter','pasien','stafrekammedis','admin','klinik']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akunpenggunas');
    }
};
