<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiUnverifikasi
{
    use AsAction;

    public function handle($tgl)
    {
        $sum = DB::SELECT("SELECT sum(a.angka_kredit) as ak from pkb_penilaian_kegiatan a
                        join pkb_kegiatan_unverified b on a.uuid = b.uuid
                        where b.user_id = '". Auth::user()->id . "'
                        and start_kegiatan = '$tgl'
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
