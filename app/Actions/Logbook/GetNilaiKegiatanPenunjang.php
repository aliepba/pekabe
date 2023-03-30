<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanPenunjang
{
    use AsAction;

    public function handle()
    {
        $sum = DB::SELECT("SELECT sum(a.angka_kredit) as ak, c.jenis  from pkb_penilaian_peserta a
        join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
        join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
        where a.id_sub_bidang = 'AS201'
        and c.id = 2")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;
    }
}
