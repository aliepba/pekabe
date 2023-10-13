<?php

namespace App\Actions\Indikator;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

class SKK7
{
    use AsAction;

    public function handle($idAsosiasi)
    {
        $data = DB::SELECT("SELECT COUNT(*) AS jml FROM 
                            lsp_pencatatan a WHERE a.`final_at` IS NOT NULL AND 
                            a.`valid`='1' AND a.`jenjang`='7' AND a.id_asosiasi = '$idAsosiasi'");

        if(empty($data)){
            $data = 0;
        }else{
            $data = $data[0]->jml;
        }

        return $data;

    }
}
