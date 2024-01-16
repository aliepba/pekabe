<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsOpenToPkbKegiatanPenyelenggara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->boolean('is_open')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkb_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->boolean('is_open')->default(false);
        });
    }
}
