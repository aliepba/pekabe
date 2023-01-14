<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('id_subklas');
            $table->foreignId('id_propinsi');
            $table->string('tahun', 10);
            $table->string('bulan');
            $table->foreign('id_kegiatan');
            $table->string('jenis_kegiatan');
            $table->string('sub_kegiatan');
            $table->foreignId('id_klas_peran');
            $table->date('start_kegiatan');
            $table->date('end_kegiatan');
            $table->string('jumlah_jam');
            $table->string('nilai_skpk');
            $table->text('upload_persyaratan');
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
        Schema::dropIfExists('old_kegiatan');
    }
}