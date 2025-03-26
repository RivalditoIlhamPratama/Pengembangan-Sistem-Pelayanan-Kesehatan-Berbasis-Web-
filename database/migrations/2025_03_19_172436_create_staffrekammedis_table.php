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
        Schema::create('staffrekammedis', function (Blueprint $table) {
            $table->id('idStaffRm');
            $table->unsignedBigInteger('id_user');
            $table->string('namaStaff');
            $table->enum('jenisKelamin',['Pria', 'Wanita']);
            $table->string('noHp');
            $table->text('alamatStaff');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffrekammedis');
    }
};
