<?php

namespace App\Actions\VerifikasiKegiatan;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Enums\PermohonanStatus;
use App\Models\Kegiatan;

class GetKegiatanSah
{
    use AsAction;

    public function handle()
    {
        return [
            'data' => Kegiatan::with(['unsurKegiatan', 'unsurKegiatan.unsur', 'user'])
                    ->where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)
                    ->orderBy('updated_at', 'asc')
                    ->get()
        ];
    }
}
