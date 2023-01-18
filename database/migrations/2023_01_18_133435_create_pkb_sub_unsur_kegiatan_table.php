<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbSubUnsurKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_sub_unsur_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_unsur_kegiatan');
            $table->foreignId('id_bobot_penilaian');
            $table->string('nama_sub_unsur');
            $table->integer('nilai_skpk');
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
        Schema::dropIfExists('pkb_sub_unsur_kegiatan');
    }
}
