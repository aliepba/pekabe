<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiUmum
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = DB::SELECT("SELECT sum(angka_kredit) as ak from pkb_penilaian_peserta a
        where a.id_sub_bidang  = '$idSub'
        and a.nik = '". Auth::user()->nik . "'
        and a.is_sifat = 0.8")[0];

        if(empty($sum)){
        $ak = 0;
        }

        if(!empty($sum)){
        $ak = $sum->ak;
        }

        return $ak;
    }
}
