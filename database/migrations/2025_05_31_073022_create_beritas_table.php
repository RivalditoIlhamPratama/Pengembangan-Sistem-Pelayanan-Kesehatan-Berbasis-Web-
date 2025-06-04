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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id('idBerita');
            $table->unsignedBigInteger('admin_id');
            $table->string('judulBerita');
            $table->longText('isiBerita');
            $table->string('tanggalBerita');
            $table->text('gambarBerita')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('idAdmin')->on('adminpuskesmas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};