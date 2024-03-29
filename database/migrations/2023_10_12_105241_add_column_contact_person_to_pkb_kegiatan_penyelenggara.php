<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnContactPersonToPkbKegiatanPenyelenggara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->string('contact_person')->nullable();
            $table->string('link_kegiatan')->nullable();
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
            $table->string('contact_person')->nullable();
            $table->string('link_kegiatan')->nullable();
        });
    }
}
