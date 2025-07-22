<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropKlinikIdFromRekammedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekammedis', function (Blueprint $table) {
            if (Schema::hasColumn('rekammedis', 'Klinik_id')) {
                $table->dropForeign(['Klinik_id']);
                $table->dropColumn('Klinik_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekammedis', function (Blueprint $table) {
            $table->unsignedBigInteger('Klinik_id')->nullable()->after('StaffRm_id');
            $table->foreign('Klinik_id')->references('idKlinik')->on('kliniks')->onDelete('set null');
        });
    }
}
