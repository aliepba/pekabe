<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class GetKegiatanSetuju
{
    use AsAction;

    public function handle()
    {
        return [
            'kegiatan' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)
                                    ->orWhere('status_permohonan_kegiatan', PermohonanStatus::PELAPORAN)
                                    ->orWhere('status_permohonan_kegiatan', PermohonanStatus::TERVERIFIKASI)
                                    ->orWhere('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)
                                    ->orWhere('status_permohonan_kegiatan', PermohonanStatus::UNVERIFIED)
                                    ->orWhere('status_permohonan_kegiatan', PermohonanStatus::VALIDASI)
                                    ->get()
        ];
    }
}
