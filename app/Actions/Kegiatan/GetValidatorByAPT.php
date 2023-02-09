<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetValidatorByAPT
{
    use AsAction;

    public function handle()
    {
        return [
            'data' => Kegiatan::where('status_permohonan_kegiatan',PermohonanStatus::APPROVE)
                                ->where('penilai', Auth::user()->jenis)
                                ->whereNull('tgl_penilaian')
                                ->get(),
        ];
    }
}
