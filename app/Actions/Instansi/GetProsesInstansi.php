<?php

namespace App\Actions\Instansi;

use App\Models\DetailInstansi;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProsesInstansi
{
    use AsAction;

    public function handle():array
    {
        return [
            'list' => DetailInstansi::
                        where('status_permohonan', 'APPROVE')
                        ->get()
        ];
    }
}
