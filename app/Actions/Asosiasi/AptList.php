<?php

namespace App\Actions\Asosiasi;

use App\Models\DetailInstansi;
use App\Models\MtAsosiasiProfesi;
use App\Models\MtAsosiasiBadanUsaha;
use Lorisleiva\Actions\Concerns\AsAction;

class AptList
{
    use AsAction;

    public function handle() :array
    {
        return [
            'profesi' => MtAsosiasiProfesi::query()
                    ->whereNotIn('ID_Asosiasi_Profesi',DetailInstansi::all())
                    ->get(),
            'badan-usaha' => MtAsosiasiBadanUsaha::query()
                    ->whereNotIn('ID_Asosiasi_BU',DetailInstansi::all())
                    ->get(),
            ];
    }
}
