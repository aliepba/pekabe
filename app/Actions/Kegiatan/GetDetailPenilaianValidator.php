<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Models\MtBobotPenilaian;
use App\Models\PesertaKegiatan;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetDetailPenilaianValidator
{
    use AsAction;

    public function handle($uuid):array
    {
        $kegiatan = Kegiatan::with(['nilaiPelaporan', 'nilaiPelaporan.unsur' ,'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur', 'peserta'])->where('uuid', $uuid)->first();

        // $idUnsur = [];
        // foreach ($kegiatan->unsurKegiatan as $unsurKegiatan){
        //     $idUnsur[] = $unsurKegiatan->unsur->id_bobot_penilaian;
        // }
        return [
            'data' => $kegiatan,
            // 'bobot' => MtBobotPenilaian::whereIn('id', $idUnsur)->get(),
            // 'peserta' => PesertaKegiatan::where('id_kegiatan', $uuid)->get()
        ];
    }
}
