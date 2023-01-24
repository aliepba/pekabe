<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_log_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan')->constrained('kegiatan_penyelenggara');
            $table->enum('status_permohonan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT', 'OPEN', 'TERVERIFIKASI' ,'UNVERIFIED' ]);
            $table->text('keterangan')->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('log_kegiatan');
    }
}
