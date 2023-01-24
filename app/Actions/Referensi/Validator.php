<?php

namespace App\Actions\Referensi;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

class Validator
{
    use AsAction;

    public function handle($subklas)
    {
        $subklas = explode(',', $subklas);
        $arraySub = array();
        $arrayKlas = array();
        $sub = DB::table('lsp_subklasifikasi')
                    ->whereIn('subklasifikasi', $subklas)
                    ->get();

        foreach($sub as $item){
            array_push($arraySub, $item->id_klasifikasi);
        }

        $klas = DB::table('lsp_klasifikasi')
                    ->whereIn('id_klasifikasi', $arraySub)
                    ->get();

        foreach($klas as $data){
            array_push($arrayKlas, $data->klasifikasi);
        }

        $apt = DB::table('pkb_personal_profesi_ta_detail')
                    ->where('Terakreditasi', '=' , '1')
                    ->whereIn('klasifikasi', $arrayKlas)
                    ->pluck('ID_Asosiasi_Profesi', 'Nama_Lengkap', 'Nama');

        return $apt;
    }
}
