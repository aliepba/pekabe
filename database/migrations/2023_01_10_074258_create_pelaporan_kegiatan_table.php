<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaporanKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporan_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->text('upload_persyaratan')->nullable();
            $table->text('materi_kegiatan');
            $table->text('dokumentasi_kegiatan');
            $table->enum('status_laporan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT', 'OPEN'])->default('OPEN');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('approve_at')->nullable();
            $table->unsignedBigInteger('approve_by')->nullable();
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
        Schema::dropIfExists('pelaporan_kegiatan');
    }
}
