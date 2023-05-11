<?php

namespace App\Actions\Kegiatan;

use Carbon\Carbon;
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
                                    ->where('start_kegiatan', '>', Carbon::now())
                                    ->orderBy('start_kegiatan', 'asc')
                                    ->get()
        ];
    }
}
