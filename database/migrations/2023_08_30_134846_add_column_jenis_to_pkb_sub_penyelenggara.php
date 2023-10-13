<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJenisToPkbSubPenyelenggara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_sub_penyelenggara', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkb_sub_penyelenggara', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis');
        });
    }
}
