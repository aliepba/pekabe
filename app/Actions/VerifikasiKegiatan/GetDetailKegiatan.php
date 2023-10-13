<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Cache;

class GetDetailKegiatan
{
    use AsAction;

    public function handle($uuid)
    {
        return [
            'data' => Kegiatan::with(['validator',
                                        'unsurKegiatan',
                                        'unsurKegiatan.unsur',
                                        'user', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])
                                        ->where('uuid', $uuid)->first(),
            'peserta' => PesertaKegiatan::where('id_kegiatan', $uuid)->get()          
        ];
    }
}
