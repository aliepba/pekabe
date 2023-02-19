<?php

namespace App\Services\Penilaian;

use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use App\Jobs\Penilaian;
use App\Models\MtBobotPenilaian;
use App\Models\PenilaianKegiatan;
use Illuminate\Support\Facades\DB;
use App\Models\PenilaianValidator;
use Illuminate\Support\Facades\Auth;

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

    public function penilaianValidator(Request $request){
        $kegiatan = Kegiatan::where('uuid', $request->id_kegiatan)->first();
        DB::transaction(function () use($request, $kegiatan){
            $kegiatan->update([
                'tgl_penilaian' => Carbon::now()
            ]);

            $idUnsur = $request->input('id_unsur');
            $nilai = $request->input('nilai_skpk');
            $jenis = $request->input('is_jenis');
            $sifat = $request->input('is_sifat');
            $metode = $request->input('is_metode');
            $tingkat = $request->input('is_tingkat');

            for($i=0; $i < count($nilai); $i++){
                PenilaianValidator::query()->create([
                    'id_kegiatan' => $kegiatan->uuid,
                    'id_unsur' => $idUnsur[$i],
                    'nilai_skpk' => $nilai[$i],
                    'is_jenis' => $jenis[$i],
                    'is_sifat' => $sifat[$i],
                    'is_metode' => $metode[$i],
                    'is_tingkat' => $tingkat[$i],
                    'angka_kredit' => (float)$nilai[$i] * ($jenis[$i] == null ? 1 : (float)$jenis[$i]) * ($sifat[$i] == null ? 1 : (float)$sifat[$i]) * ($metode[$i] == null ? 1 : (float)$metode[$i]) * ($tingkat[$i] == null ? 1 : (float)$tingkat[$i]),
                    'validate_by' => Auth::user()->id
                ]);
            }

            LogKegiatan::query()->create([
                 'id_kegiatan' => $request->id_kegiatan,
                'status_permohonan' => PermohonanStatus::PENILAIAN,
                'keterangan' => 'kegiatan sudah dilakukan penilaian oleh validator',
                'user' => 1
            ]);
        });
    }
}
