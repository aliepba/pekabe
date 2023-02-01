<?php

namespace App\Jobs;

use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use App\Models\PenilaianKegiatan;
use App\Models\MtSubUnsurKegiatan;
use Illuminate\Support\Facades\DB;
use App\Enums\PermohonanStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class isVerifikasi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        $kegiatan = Kegiatan::with(['laporan'])
                    ->where('status_permohonan_kegiatan', 'APPROVE')
                    ->whereNull('is_verifikasi')
                    ->get();

        foreach ($kegiatan as $item) {
            $DeferenceInDays = \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($item->end_kegiatan);
            if($DeferenceInDays >= 15 && empty($item->laporan)){
                $this->unverified($item->uuid);
            }
        }
    }

    public function unverified($uuid){
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $unsurKegiatan){
            $kegiatan->update([
                'is_verifikasi' => 0
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
            $jenis = $unsurKegiatan->bobot->not_verif_penyelenggara != null ? $unsurKegiatan->bobot->not_verif_penyelenggara : $unsurKegiatan->bobot->mandiri;
            $sifat = $unsurKegiatan->bobot->khusus;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $unsurKegiatan->bobot->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $unsurKegiatan->bobot->internasional_dalam_negeri;
            }else{
                $tingkat = $unsurKegiatan->bobot->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'uuid' => $kegiatan->uuid,
                'nilai_skpk' => $unsurKegiatan->nilai_skpk,
                'is_jenis' => $jenis,
                'is_sifat' => $unsurKegiatan->bobot->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : $jenis) * ($sifat == null ? 1 : $sifat) * ($metode == null ? 1 : $metode) * ($tingkat == null ? 1 : $tingkat)
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
