<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNamaTenagaAhli
{
    use AsAction;

    public function handle($nik):string
    {
        $data = DB::SELECT("SELECT p.Nama as nama  FROM personal p WHERE p.id_personal = '$nik'
                            UNION
                            SELECT lp.nama  as nama FROM lsp_personal lp WHERE lp.nik = '$nik'");

        if(empty($data)){
            $nama = "Tidak Memiliki SKA/SKT/SKK";
        }

        if(!empty($data)){
            $response = $data[0];
            $nama = $response->nama;
        }

        return $nama;
    }
}
