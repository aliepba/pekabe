<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAll
{
    use AsAction;

    public function handle():array
    {
        return [
            'data' => Kegiatan::with(['validator', 'user'])
                                ->where('status_permohonan_kegiatan', 'SUBMIT')
                                ->get()
        ];
    }
}
