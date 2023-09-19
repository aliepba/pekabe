<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNamaTenagaAhli
{
    use AsAction;

    public function handle($nik):string
    {

        $data = array();

        $ska = DB::SELECT("SELECT p.Nama as nama  FROM personal p WHERE p.id_personal = '$nik'");

        if(!$ska){
            $skk = DB::SELECT("SELECT lp.nama as nama FROM lsp_personal lp WHERE lp.nik = '$nik'");

            if(!empty($skk)){
                array_push($data, $skk[0]);
            }
        }else{
            array_push($data, $ska[0]);
        }

        if(empty($data)){
            $nama = "Tidak Memiliki SKA/SKT/SKK";
        }

        if(!empty($data)){
            $nama = $data[0]->nama;
        }

        return $nama;
    }
}
