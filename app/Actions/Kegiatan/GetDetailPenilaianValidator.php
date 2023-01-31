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
        $kegiatan = Kegiatan::with(['nilaiPelaporan', 'jenis', 'unsur'])->where('uuid', $uuid)->first();
        return [
            'data' => $kegiatan,
            'bobot' => MtBobotPenilaian::find($kegiatan->unsur->id_bobot_penilaian)
        ];
    }
}
