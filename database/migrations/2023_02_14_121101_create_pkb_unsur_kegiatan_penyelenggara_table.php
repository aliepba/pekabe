<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbUnsurKegiatanPenyelenggaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_unsur_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->string('id_unsur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pkb_unsur_kegiatan_penyelenggara');
    }
}
