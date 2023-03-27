<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiByIDSub
{
    use AsAction;

    public function handle()
    {
        $sum = DB::SELECT("select sum(angka_kredit) as ak from pkb_penilaian_peserta where id_sub_bidang ='AS201'")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;
    }
}
