<?php

namespace App\Actions\Instansi;

use App\Models\DetailInstansi;
use App\Enums\PermohonanStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTolakPenyelenggara
{
    use AsAction;

    public function handle()
    {
        return [
            'list' => DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)->get()
        ];
    }
}
