<?php

namespace App\Actions\Asosiasi;

use App\Models\DetailInstansi;
use App\Enums\PermohonanStatus;
use App\Models\MtAsosiasiProfesi;
use App\Models\MtAsosiasiBadanUsaha;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;       
use Illuminate\Support\Facades\Cache;

class AsosiasiList
{
    use AsAction;

    public function handle() :array
    {
        return [
                'profesi' => Cache::rememberForever('cached_profesi',  function(){
                        return MtAsosiasiProfesi::query()
                        ->whereNotIn('ID_Asosiasi_Profesi',DetailInstansi::where('jenis', 2)->where('status_permohonan', PermohonanStatus::APPROVE)->get('penyelenggara'))
                        ->get();
                        }),
                'badanUsaha' => Cache::rememberForever('cached_bu', function () {
                        return MtAsosiasiBadanUsaha::query()
                        ->whereNotIn('ID_Asosiasi_BU',DetailInstansi::where('jenis', 3)->where('status_permohonan', PermohonanStatus::APPROVE)->get('penyelenggara'))
                        ->get();
                }),
            ];
    }
}
