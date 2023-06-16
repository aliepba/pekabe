<?php

namespace helpers;

use App\Actions\Logbook\GetNilaiByIDSub;

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

        $ak = GetNilaiByIDSub::run($idSub, $tgl);

        $status = $ak - $syarat;

        return $status > $syarat ? 'Memenuhi' : "Tidak Memenuhi";

    }
}
