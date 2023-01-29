<?php

namespace App\Actions\Referensi;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

class Validator
{
    use AsAction;

    public function handle($sub)
    {
        $subklas = explode(',', $sub);

        $apt = DB::table('pkb_personal_profesi_ta_detail')
            ->join('lsp_klasifikasi', 'pkb_personal_profesi_ta_detail.klasifikasi', '=', 'lsp_klasifikasi.klasifikasi')
            ->join('lsp_subklasifikasi', 'lsp_klasifikasi.id_klasifikasi', '=', 'lsp_subklasifikasi.id_klasifikasi')
            ->where('Terakreditasi', '=' , '1')
            ->whereIn('lsp_subklasifikasi.subklasifikasi', $subklas)
            ->groupBy('ID_Asosiasi_Profesi')
            ->get(['ID_Asosiasi_Profesi', 'Nama_Lengkap', 'Nama']);

        return $apt;
    }
}
