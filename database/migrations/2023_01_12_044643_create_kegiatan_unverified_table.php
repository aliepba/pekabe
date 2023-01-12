<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanUnverifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_unverified', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->text('nama_kegiatan');
            $table->foreign('id_unsur_kegiatan');
            $table->text('nama_penyelenggara');
            $table->string('tempat_Kegiatan');
            $table->date('start_kegiatan');
            $table->date('end_kegiatan');
            $table->integer('jumlah_jam')->nullable();
            $table->foreignId('id_klasifikasi');
            $table->string('tingkat_kegiatan');
            $table->text('upload_persyaratan');
            $table->enum('status_permohonan_kegiatan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT', 'OPEN'])->default('SUBMIT');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('kegiatan_unverified');
    }
}
