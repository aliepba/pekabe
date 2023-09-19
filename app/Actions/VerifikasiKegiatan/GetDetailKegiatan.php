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
            'data' => Cache::rememberForever('detail', function() use ($uuid) {
                        Kegiatan::with(['validator',
                                        'unsurKegiatan',
                                        'unsurKegiatan.unsur',
                                        'user', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])
                                        ->where('uuid', $uuid)->first();
                    }),
            'peserta' => Cache::rememberForever('pesertaDetail', function() use ($uuid){
                        PesertaKegiatan::where('id_kegiatan', $uuid)->get();                
                    })
        ];
    }
}
