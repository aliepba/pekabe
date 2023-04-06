<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanUtama
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
                    select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
                    join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
                    join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                    where a.id_sub_bidang = '$idSub'
                    and c.jenis = 'Kegiatan Utama'
                    and a.nik  = '". Auth::user()->nik . "'
                    union
                    select sum(b.angka_kredit) as ak from pkb_kegiatan_unverified a
                    join pkb_penilaian_kegiatan b on a.uuid = b.uuid
                    join pkb_sub_unsur_kegiatan c on a.id_unsur_kegiatan = c.id
                    join pkb_master_unsur_kegiatan d on c.id_unsur_kegiatan  = d.id
                    where d.jenis = 'Kegiatan Utama'
                    and user_id = '". Auth::user()->id . "'
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
