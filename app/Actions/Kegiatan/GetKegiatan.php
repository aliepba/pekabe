<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetKegiatan
{
    use AsAction;

    public function handle() :array
    {
        return [
            'setuju' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->get(),
            'tolak' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)->get()
        ];
    }
}
