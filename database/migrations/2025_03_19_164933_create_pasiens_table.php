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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id('idPasien');
            $table->unsignedBigInteger('user_id');
            $table->string('namaPasien');
            $table->enum('jenisKelamin',['Laki-laki', 'Perempuan']);
            $table->string('noHp');
            $table->text('alamatPasien');
            $table->string('email');

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
