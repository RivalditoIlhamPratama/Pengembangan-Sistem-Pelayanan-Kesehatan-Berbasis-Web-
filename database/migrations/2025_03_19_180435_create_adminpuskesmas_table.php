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
        Schema::create('adminpuskesmas', function (Blueprint $table) {
            $table->id('idAdmin');
            $table->unsignedBigInteger('id_user');
            $table->enum('jenisKelamin',['Pria', 'Wanita']);
            $table->string('noHp');
            $table->text('alamatAdmin');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminpuskesmas');
    }
};