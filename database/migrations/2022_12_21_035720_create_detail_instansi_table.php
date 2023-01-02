<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailInstansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('jenis')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('email_instansi');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('propinsi');
            $table->string('kab_kota');
            $table->enum('status_permohonan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT'])->default('SUBMIT');
            $table->text('file1')->nullable();
            $table->text('file2')->nullable();
            $table->text('file3')->nullable();
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
        Schema::dropIfExists('detail_instansi');
    }
}
