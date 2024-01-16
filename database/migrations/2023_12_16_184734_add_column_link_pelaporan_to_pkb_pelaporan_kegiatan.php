<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLinkPelaporanToPkbPelaporanKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_pelaporan_kegiatan', function (Blueprint $table) {
            $table->text('link_pelaporan')->nullable();
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkb_pelaporan_kegiatan', function (Blueprint $table) {
            $table->text('link_pelaporan')->nullable();
        });
    }
}
