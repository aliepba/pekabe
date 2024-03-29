<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKhusus
{
    use AsAction;

    public function handle($idSub, $tgl)
    {
        $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
            select sum(angka_kredit) as ak from pkb_penilaian_peserta a
            where a.id_sub_bidang  = '$idSub'
            and a.nik = '". Auth::user()->nik . "'
            and a.is_sifat = 1
            union
            select sum(angka_kredit) as ak from pkb_penilaian_kegiatan x
            join pkb_kegiatan_unverified y on x.uuid = y.uuid
            where y.user_id = '". Auth::user()->id . "'
            and start_kegiatan >=  '$tgl'
        ) as total")[0];

        if(empty($sum)){
        $ak = 0;
        }

        if(!empty($sum)){
        $ak = $sum->ak;
        }

        return $ak;
    }
}
