<?php

namespace helpers;

use App\Actions\Logbook\GetNilaiByIDSub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyHelper
{
    
    public static function nilaiSyarat($syrt,$jenjang){
        $utama = 200;
        $madya = 150;
        $muda = 100;

        if($jenjang == 'Utama' || $jenjang == '9'){
            $syarat = $utama * $syrt/100;
        }

        if($jenjang == 'Madya' || $jenjang =='8'){
            $syarat = $madya * $syrt/100;
        }

        if($jenjang == 'Muda' || $jenjang == '7'){
            $syarat = $muda * $syrt/100;
        }

        return $syarat ?? 0;
    }

    public static function syarat($jenjang){
        if($jenjang == 'Utama' || $jenjang == '9')
        {
            $syarat = 200;
        }

        if($jenjang == 'Madya' || $jenjang == '8'){
            $syarat = 150;
        }

        if($jenjang == 'Muda' || $jenjang == '7'){
            $syarat = 100;
        }

        return $syarat ?? 0;
    }

    public static function status($jenjang, $idSub, $tgl){
        $syarat = self::syarat($jenjang);

        $verified  = DB::select("select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
                            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
                            join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                            where a.id_sub_bidang = '$idSub'
                            and a.nik  = '". Auth::user()->nik . "'")[0];
        
        if($syarat > $verified){
            return 'Tidak Memenuh';
        }

        $ak = GetNilaiByIDSub::run($idSub, $tgl);

        $status = $ak - $syarat;

        return ($status > $syarat) ? 'Memenuhi' : "Tidak Memenuhi";

    }
}
