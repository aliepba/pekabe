<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAll
{
    use AsAction;

    public function handle()
    {
        return [
            'data' => Kegiatan::with(['validator'])->where('status_permohonan_kegiatan', 'SUBMIT')->get()
        ];
    }
}
