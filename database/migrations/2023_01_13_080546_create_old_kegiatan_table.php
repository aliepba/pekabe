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
        Schema::create('pkb_old_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('id_subklas');
            $table->foreignId('id_propinsi');
            $table->string('tahun', 10);
            $table->string('bulan');
            $table->unsignedBigInteger('id_kegiatan');
            $table->string('jenis_kegiatan')->nullable();
            $table->string('sub_kegiatan')->nullable();
            $table->foreignId('id_klas_peran')->nullable();
            $table->date('start_kegiatan')->nullable();
            $table->date('end_kegiatan')->nullable();
            $table->string('jumlah_jam')->nullable();
            $table->string('nilai_skpk')->nullable();
            $table->string('tingkat_kegiatan')->nullable();
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
