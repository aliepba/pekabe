<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiKegiatanPenunjang
{
    use AsAction;

    public function handle($idSub, $tgl)
    {
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
            select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
            where a.id_sub_bidang = '$idSub'
            and c.jenis = 'Kegiatan Penunjang'
            and a.nik  = '". Auth::user()->nik . "'
            union
            select sum(x.angka_kredit) from pkb_penilaian_kegiatan x
			join pkb_kegiatan_unverified w on x.uuid = w.uuid
			join pkb_sub_unsur_kegiatan y on w.id_unsur_kegiatan = y.id 
			join pkb_master_unsur_kegiatan z on y.id_unsur_kegiatan = z.id 
			where z.jenis = 'Kegiatan Penunjang'
			and w.user_id = '". Auth::user()->id ."'
            and start_kegiatan = '$tgl'
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
