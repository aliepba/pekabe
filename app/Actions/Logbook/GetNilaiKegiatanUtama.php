<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanUtama
{
    use AsAction;

    public function handle($idSub, $tgl)
    {
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
                    SELECT sum(a.angka_kredit) as ak  FROM pkb_penilaian_peserta a
                    JOIN pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
                    JOIN pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                    WHERE a.id_sub_bidang = '$idSub'
                    AND c.jenis = 'Kegiatan Utama'
                    AND a.nik  = '". Auth::user()->nik . "'
                    UNION
                    SELECT sum(b.angka_kredit) as ak FROM pkb_kegiatan_unverified a
                    JOIN pkb_penilaian_kegiatan b on a.uuid = b.uuid
                    JOIN pkb_sub_unsur_kegiatan c on a.id_unsur_kegiatan = c.id
                    JOIN pkb_master_unsur_kegiatan d on c.id_unsur_kegiatan  = d.id
                    WHERE d.jenis = 'Kegiatan Utama'
                    AND user_id = '". Auth::user()->id . "'
                    AND start_kegiatan >= '$tgl'
                    UNION
                    SELECT sum(a.angka_kredit) as ak FROM pkb_penilaian_api a
                    WHERE a.id_sub_bidang  = '$idSub'
                    AND a.nik = '". Auth::user()->nik . "'
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
