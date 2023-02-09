<?php

namespace App\Actions\Kegiatan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPKBV1
{
    use AsAction;

    public function handle()
    {
        return [
            'data' => DB::table('kegiatan_teregistrasi')
                    ->where('id_input', Auth::user()->id)
                    ->get()
        ];
    }
}
