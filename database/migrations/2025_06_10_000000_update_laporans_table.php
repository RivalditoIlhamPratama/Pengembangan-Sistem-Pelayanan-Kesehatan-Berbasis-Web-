<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            // Add rekammedis fields to laporan table
            $table->string('namaPasien')->nullable();
            $table->string('namaDokter')->nullable();
            $table->string('diagnosaMedis')->nullable();
            $table->string('NIK')->nullable();
            $table->string('alamatPasien')->nullable();
            $table->timestamps();
            // Add other rekammedis fields as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn([
                'namaPasien',
                'namaDokter',
                'diagnosaMedis',
                'NIK',
                'alamatPasien',
            ]);
        });
    }
}
