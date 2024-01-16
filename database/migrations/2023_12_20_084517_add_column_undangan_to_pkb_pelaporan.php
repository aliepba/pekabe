<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUndanganToPkbPelaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_pelaporan_kegiatan', function (Blueprint $table) {
            $table->text('undangan_kegiatan')->default(null);
            $table->text('daftar_hadir')->default(null);
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
            $table->text('undangan_kegiatan')->default(null);
            $table->text('daftar_hadir')->default(null);
        });
    }
}
