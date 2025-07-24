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
            $table->unsignedBigInteger('user_id');
            $table->string('namaStaff');
            $table->enum('jenisKelamin',['Laki-Laki', 'Perempuan']);
            $table->string('noHp');
            $table->text('alamatStaff');
            $table->string('email');
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
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
