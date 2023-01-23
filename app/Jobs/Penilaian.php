<?php

namespace App\Jobs;

use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use App\Models\PenilaianKegiatan;
use App\Models\PelaporanKegiatan;
use App\Models\MtSubUnsurKegiatan;
use Illuminate\Support\Facades\DB;
use App\Enums\PermohonanStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Penilaian implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $this->verifikasi($this->id);
    }

    public function verifikasi($id){
        $pelaporan = PelaporanKegiatan::findOrFail($id);
        $kegiatan = Kegiatan::where('uuid',$pelaporan->id_kegiatan)->first();
        $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $unsurKegiatan){
            $kegiatan->update([
                'is_verifikasi' => 1
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
            $jenis = $unsurKegiatan->bobot->verif != null ? $unsurKegiatan->bobot->verif : $unsurKegiatan->bobot->mandiri;

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
                'angka_kredit' => $unsurKegiatan->nilai_skpk * $jenis * 1 * $metode * $tingkat
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::TERVERIFIKASI,
                'keterangan' => 'kegiatan terverifikasi',
                'user' => 1
            ]);


        });
    }
}
