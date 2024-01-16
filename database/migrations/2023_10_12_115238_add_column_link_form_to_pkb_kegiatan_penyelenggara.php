<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLinkFormToPkbKegiatanPenyelenggara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->text('link_form')->nullable();
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
            $table->text('link_form')->nullable();
        });
    }
}
