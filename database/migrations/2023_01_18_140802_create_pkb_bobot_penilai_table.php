<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbBobotPenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_bobot_penilai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unsur');
            $table->decimal('verif')->nullable();
            $table->decimal('not_verif_penyelenggara')->nullable();
            $table->decimal('not_verif_not_penyelenggara')->nullable();
            $table->decimal('mandiri')->nullable();
            $table->decimal('umum')->nullable();
            $table->decimal('khusus')->nullable();
            $table->decimal('tatap_muka')->nullable();
            $table->decimal('daring')->nullable();
            $table->decimal('nasional')->nullable();
            $table->decimal('internasional_dalam_negeri')->nullable();
            $table->decimal('internasional_luar_negeri')->nullable();
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
        Schema::dropIfExists('pkb_bobot_penilai');
    }
}
