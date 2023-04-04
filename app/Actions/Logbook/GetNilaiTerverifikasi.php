<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiTerverifikasi
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = DB::SELECT("SELECT sum(a.angka_kredit) as ak
                from pkb_penilaian_peserta a
                where a.id_sub_bidang = '$idSub'
                and a.nik = '". Auth::user()->nik . "'
                ")[0];

        if(empty($sum)){
        $ak = 0;
        }

        if(!empty($sum)){
        $ak = $sum->ak;
        }

        return $ak;
    }
}
