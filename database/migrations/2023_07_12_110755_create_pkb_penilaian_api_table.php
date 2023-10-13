<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbPenilaianApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_penilaian_api', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->string('id_unsur');
            $table->string('nik');
            $table->string('id_sub_bidang')->nullable();
            $table->decimal('is_jenis')->nullable();
            $table->decimal('is_sifat')->nullable();
            $table->decimal('is_metode')->nullable();
            $table->decimal('is_tingkat')->nullable();
            $table->decimal('angka_kredit')->nullable();
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
        Schema::dropIfExists('pkb_penilaian_api');
    }
}
