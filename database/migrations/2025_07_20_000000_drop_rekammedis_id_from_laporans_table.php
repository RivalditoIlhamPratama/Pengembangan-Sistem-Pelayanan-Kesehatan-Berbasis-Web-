<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRekammedisIdFromLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporans', function (Blueprint $table) {
            if (Schema::hasColumn('laporans', 'RekamMedis_id')) {
                $table->dropForeign(['RekamMedis_id']);
                $table->dropColumn('RekamMedis_id');
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
        Schema::table('laporans', function (Blueprint $table) {
            $table->unsignedBigInteger('RekamMedis_id')->nullable()->after('Klinik_id');
            $table->foreign('RekamMedis_id')->references('idRekamMedis')->on('rekammedis')->onDelete('set null');
        });
    }
}
