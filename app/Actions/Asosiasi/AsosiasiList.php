<?php

namespace App\Actions\Asosiasi;

use App\Models\DetailInstansi;
use App\Enums\PermohonanStatus;
use App\Models\MtAsosiasiProfesi;
use App\Models\MtAsosiasiBadanUsaha;
use Lorisleiva\Actions\Concerns\AsAction;

class AsosiasiList
{
    use AsAction;

    public function handle() :array
    {
        return [
            'profesi' => MtAsosiasiProfesi::query()
                    ->whereNotIn('ID_Asosiasi_Profesi',DetailInstansi::where('jenis', 2)->where('status_permohonan', PermohonanStatus::APPROVE)->get('penyelenggara'))
                    ->get(),
            'badanUsaha' => MtAsosiasiBadanUsaha::query()
                    ->whereNotIn('ID_Asosiasi_BU',DetailInstansi::where('jenis', 3)->where('status_permohonan', PermohonanStatus::APPROVE)->get('penyelenggara'))
                    ->get(),
            ];
    }
}
