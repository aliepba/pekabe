<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPenilaian
{
    use AsAction;

    public function handle()
    {
        return [
            'data' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::VALIDASI)
                    ->where('is_open', false)
                    ->get()
        ];
    }
}
