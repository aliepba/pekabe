<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPenyelenggaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkb_kegiatan_penyelenggara', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('penyelenggara_lain')->nullable();
            $table->text('subklasifikasi');
            $table->string('penilai');
            $table->string('jenis_kegiatan');
            $table->string('unsur_kegiatan')->nullable();
            $table->string('metode_kegiatan');
            $table->string('tingkat_kegiatan');
            $table->date('tgl_pengajuan')->nullable();
            $table->string('nama_kegiatan');
            $table->string('tempat_kegiatan');
            $table->date('start_kegiatan');
            $table->date('end_kegiatan');
            $table->text('surat_permohonan');
            $table->text('tor_kak');
            $table->text('sk_panitia');
            $table->text('cv');
            $table->text('persyaratan_lain')->nullable();
            $table->text('persyaratan_lain_lain')->nullable();
            $table->enum('status_permohonan_kegiatan', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT', 'OPEN', 'APPROVE SISTEM', 'VALIDASI', 'PELAPORAN', 'PENGESAHAN', 'UNVERIFIED', 'TERVERIFIKASI', 'PENILAIAN'])->default('OPEN');
            $table->enum('status_permohonan_penyelenggara', ['APPROVE', 'PERBAIKAN', 'TOLAK', 'SUBMIT', 'OPEN', 'APPROVE SISTEM', 'VALIDASI', 'PELAPORAN', 'PENGESAHAN', 'UNVERIFIED', 'TERVERIFIKASI', 'PENILAIAN'])->default('OPEN');
            $table->string('id_penyelenggara')->nullable();
            $table->string('user_id');
            $table->text('keterangan')->nullable();
            $table->boolean('is_verifikasi')->nullable();
            $table->date('tgl_proses')->nullable();
            $table->date('tgl_penilaian')->nullable();
            $table->text('keterangan_verifikasi')->nullable();
            $table->text('keterangan_pengesahan')->nullable();
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
        Schema::dropIfExists('kegiatan_penyelenggara');
    }
}
