<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDetailPenilaian
{
    use AsAction;

    public function handle($uuid)
    {
        return [
            'data' => Kegiatan::with(['validator',
                                'unsurKegiatan',
                                'unsurKegiatan.unsur',
                                'user', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])
                                ->where('uuid', $uuid)->first()
        ];
    }
}
