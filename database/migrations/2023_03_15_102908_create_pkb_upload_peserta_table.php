<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbUploadPesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_upload_peserta', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan')->nullable();
            $table->string('nik');
            $table->string('metode');
            $table->string('unsur_peserta')->nullable();
            $table->boolean('acc')->default(0);
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('pkb_upload_peserta');
    }
}
