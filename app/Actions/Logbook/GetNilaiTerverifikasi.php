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
        $ak = 0;
        $nik = Auth::user()->nik;

        $sum = DB::SELECT("SELECT SUM(total.ak) as ak from (
                            SELECT SUM(a.angka_kredit) as ak
                                FROM pkb_penilaian_peserta a
                                WHERE a.id_sub_bidang = '$idSub'
                                AND a.nik = '$nik'
                            UNION 
                            SELECT SUM(a.angka_kredit) as ak FROM pkb_penilaian_api a
                            WHERE a.id_sub_bidang  = '$idSub'
                            AND a.nik  = '$nik'
                            ) as total")[0];

        return empty($sum) ? $ak : $ak = $sum->ak;
    }
}
