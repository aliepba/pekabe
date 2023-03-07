<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbPengesahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_pengesahan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->unsignedBigInteger('is_nama')->default(0);
            $table->unsignedBigInteger('is__unsur')->default(0);
            $table->unsignedBigInteger('is_metode')->default(0);
            $table->unsignedBigInteger('is_tingkat')->default(0);
            $table->unsignedBigInteger('is_subklas')->default(0);
            $table->unsignedBigInteger('is_laporan')->default(0);
            $table->unsignedBigInteger('is_materi')->default(0);
            $table->unsignedBigInteger('is_dokumentasi')->default(0);
            $table->unsignedBigInteger('is_ba_verifikasi')->default(0);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pkb_pengesahan');
    }
}
