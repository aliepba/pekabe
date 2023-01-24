<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_log_permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('id_detail_instansi')->constrained('detail_instansi');
            $table->enum('status_permohonan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT']);
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
        Schema::dropIfExists('log_permohonan');
    }
}
