<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDetailKegiatan
{
    use AsAction;

    public function handle($uuid)
    {
        return [
            'data' => Kegiatan::with(['validator', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first()
        ];
    }
}
