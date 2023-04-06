<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanNonFormal
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
                    select sum(a.angka_kredit) as ak from pkb_penilaian_peserta a
                    join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
                    where b.id_unsur_kegiatan = 2
                    and a.id_sub_bidang = '$idSub'
                    and a.nik = '". Auth::user()->nik . "'
                    union
                    select sum(a.angka_kredit) as ak  from pkb_penilaian_kegiatan a
                    join pkb_kegiatan_unverified b on a.uuid = b.uuid
                    join pkb_sub_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                    where b.user_id = '". Auth::user()->id . "'
                    and c.id_unsur_kegiatan = 2
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
