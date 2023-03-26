<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPenilaianValidator
{
    use AsAction;

    public function handle():array
    {
        return [
            'data' => Kegiatan::with(['user'])->where('status_permohonan_kegiatan',PermohonanStatus::PELAPORAN)->get(),
        ];
    }
}
