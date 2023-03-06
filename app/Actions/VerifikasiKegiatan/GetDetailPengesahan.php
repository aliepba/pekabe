<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDetailPengesahan
{
    use AsAction;

    public function handle($uuid)
    {
        return [
            'data' => Kegiatan::with(['jenis', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first()
        ];
    }
}
