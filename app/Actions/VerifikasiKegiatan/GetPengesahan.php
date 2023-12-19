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
            'data' => Kegiatan::with(['unsurKegiatan', 'unsurKegiatan.unsur', 'user'])
                    ->where('status_permohonan_kegiatan', PermohonanStatus::VALIDASI)
                    ->where('is_open', false)
                    ->orderBy('updated_at', 'asc')
                    ->get()
        ];
    }
}
