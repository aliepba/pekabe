<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPengesahan
{
    use AsAction;

    public function handle():array
    {
        return [
            'data' => Kegiatan::with(['unsurKegiatan', 'unsurKegiatan.unsur', 'pelaporan'])->where('status_permohonan_kegiatan', PermohonanStatus::PENILAIAN)->get()
        ];
    }
}