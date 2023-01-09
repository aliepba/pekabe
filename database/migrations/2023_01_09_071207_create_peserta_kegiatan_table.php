<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_kegiatan', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignId('id_kegiatan');
            $table->string('nik_peserta');
            $table->string('unsur_kegiatan');
            $table->string('metode_kegiatan');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_kegiatan');
    }
}
