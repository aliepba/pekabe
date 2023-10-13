<?php

namespace App\Jobs;

use App\Actions\Logbook\TenagaAhli;
use App\Models\Pengembangan\PesertaAPI;
use App\Models\Pengembangan\PenilaianAPI;
use App\Models\MtSubUnsurKegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PengembanganJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = PesertaAPI::whereNull('is_sah')->get();

        foreach($data as $item){
            $item->update([
                'is_sah' => true
            ]);

            $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($item->unsur);

            $tingkat = 1;
            $jenis = 1;
            $metode = $item->metode == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
            $sifat = $unsurKegiatan->bobot->khusus;

            foreach(TenagaAhli::run($item->nik) as $sub){
                foreach($sub as $s){
                    PenilaianAPI::query()->create([
                        'id_kegiatan' => $item->id_kegiatan,
                        'id_unsur' => $item->unsur,
                        'nik' => $item->nik,
                        'id_sub_bidang' => $s->id_sub_bidang,
                        'is_jenis' => $jenis,
                        'is_sifat' => $sifat,
                        'is_metode' => $metode,
                        'is_tingkat' => $tingkat,
                        'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                    ]);
                }
            }
        }
    }
}
