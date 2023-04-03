<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanSelainNonFormal
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
            select sum(a.angka_kredit) as ak from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            where b.id_unsur_kegiatan not in ('2')
            and a.id_sub_bidang = '$idSub'
            and a.nik = '". Auth::user()->nik . "'
            union
            select sum(x.angka_kredit) as ak from pkb_penilaian_kegiatan x
            join pkb_sub_unsur_kegiatan y on x.id_unsur = y.id
            join pkb_kegiatan_unverified z on x.uuid = z.uuid
            where y.id_unsur_kegiatan not in ('2')
            and z.user_id = '". Auth::user()->id . "'
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
