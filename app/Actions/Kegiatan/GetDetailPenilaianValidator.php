<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Models\MtBobotPenilaian;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDetailPenilaianValidator
{
    use AsAction;

    public function handle($uuid):array
    {
        $kegiatan = Kegiatan::with(['nilaiPelaporan', 'nilaiPelaporan.unsur' ,'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first();
        $idUnsur = [];
        foreach ($kegiatan->unsurKegiatan as $unsurKegiatan){
            $idUnsur[] = $unsurKegiatan->unsur->id_bobot_penilaian;
        }
        return [
            'data' => $kegiatan,
            'bobot' => MtBobotPenilaian::whereIn('id', $idUnsur)->get()
        ];
    }
}
