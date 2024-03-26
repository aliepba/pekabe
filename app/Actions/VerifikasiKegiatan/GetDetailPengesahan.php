<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDetailPengesahan
{
    use AsAction;

    public function handle($uuid)
    {
        return [
            'data' => Kegiatan::with(['jenis', 'unsurKegiatan', 'unsurKegiatan.unsur', 'laporan'])->where('uuid', $uuid)->first(),
            'peserta' => PesertaKegiatan::where('id_kegiatan', $uuid)->paginate(10)
        ];
    }
}
