<?php

namespace helpers;

class MyHelper
{
    public static function nilaiSyarat($syrt,$jenjang)
    {
        $utama = 200;
        $madya = 150;
        $muda = 100;

        if($jenjang == 'Utama' || ($jenjang == '9' || $jenjang =='8' || $jenjang == '7')){
            $syarat = $utama * $syrt/100;
        }

        if($jenjang == 'Madya' || ($jenjang == '6' || $jenjang =='5' || $jenjang == '4')){
            $syarat = $madya * $syrt/100;
        }

        if($jenjang == 'Muda' || ($jenjang == '3' || $jenjang =='2' || $jenjang == '1')){
            $syarat = $muda * $syrt/100;
        }

        return $syarat;
    }
}
