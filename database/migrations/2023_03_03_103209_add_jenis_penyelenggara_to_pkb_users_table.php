<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisPenyelenggaraToPkbUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkb_users', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_penyelenggara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkb_users', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_penyelenggara');
        });
    }
}
