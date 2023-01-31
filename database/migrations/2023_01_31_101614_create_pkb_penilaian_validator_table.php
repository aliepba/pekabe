<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkbPenilaianValidatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_penilaian_validator', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->decimal('nilai_skpk')->nullable();
            $table->decimal('is_jenis')->nullable();
            $table->decimal('is_sifat')->nullable();
            $table->decimal('is_metode')->nullable();
            $table->decimal('is_tingkat')->nullable();
            $table->decimal('angka_kredit')->nullable();
            $table->unsignedBigInteger('validate_by');
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
        Schema::dropIfExists('pkb_penilaian_validator');
    }
}
