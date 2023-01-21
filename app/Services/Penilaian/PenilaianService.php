<?php

namespace App\Services\Penilaian;

use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use App\Enums\PermohonanStatus;
use App\Models\MtBobotPenilaian;
use App\Models\PenilaianKegiatan;
use Illuminate\Support\Facades\DB;

class PenilaianService{
    public function verifikasi($uuid){
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        $bobotPenilaian = MtBobotPenilaian::find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $bobotPenilaian){
            $kegiatan->update([
                'is_verifikasi' => 1
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $bobotPenilaian->tatap_muka : $bobotPenilaian->daring;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $bobotPenilaian->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $bobotPenilaian->internasional_dalam_negeri;
            }else{
                $tingkat = $bobotPenilaian->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'is_jenis' => 1,
                'is_sifat' => $bobotPenilaian->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => 1 * 1 * $metode * $tingkat
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::TERVERIFIKASI,
                'keterangan' => 'kegiatan terverifikasi',
                'user' => 1
            ]);


        });
    }

    public function unverified($uuid){
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        $bobotPenilaian = MtBobotPenilaian::find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $bobotPenilaian){
            $kegiatan->update([
                'is_verifikasi' => 0
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $bobotPenilaian->tatap_muka : $bobotPenilaian->daring;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $bobotPenilaian->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $bobotPenilaian->internasional_dalam_negeri;
            }else{
                $tingkat = $bobotPenilaian->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'is_jenis' => $bobotPenilaian->not_verif_penyelenggara,
                'is_sifat' => $bobotPenilaian->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => 1 * $bobotPenilaian->not_verif_penyelenggara * $metode * $tingkat
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::UNVERIFIED,
                'keterangan' => 'kegiatan tidak terverifikasi',
                'user' => 1
            ]);


        });
    }
}
