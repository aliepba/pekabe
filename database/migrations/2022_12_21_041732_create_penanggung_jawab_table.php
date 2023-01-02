<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanggungJawabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggung_jawab_pkb', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penanggung_jawab');
            $table->string('nik');
            $table->string('jabatan');
            $table->string('email');
            $table->string('npwp');
            $table->string('password');
            $table->string('upload_persyaratan');
            $table->string('id_detail_instansi')->constrained('detail_instansi');
            $table->softDeletes();
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
        Schema::dropIfExists('penanggung_jawab_pkb');
        Schema::table('penanggung_jawab_pkb', function(Blueprint $table){
            $table->dropForeign(['id_detail_instansi']);
            $table->dropColumn(['id_detail_instansi']);
        });
    }
}
