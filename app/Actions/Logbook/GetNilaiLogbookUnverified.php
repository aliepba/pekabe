<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiLogbookUnverified
{
    use AsAction;

    public function handle($tglKegiatan,$idKegiatan)
    {
        $nilai = DB::select("select a.angka_kredit from pkb_penilaian_kegiatan a
                    join pkb_kegiatan_unverified b on a.uuid = b.uuid 
                    where b.start_kegiatan >= :tglKegiatan
                    and b.uuid = :idKegiatan", [
                        'tglKegiatan' => $tglKegiatan,
                        'idKegiatan' => $idKegiatan
                    ]);

    

        if (empty($nilai)) {
            $nilai = '-';
        } else {
            $nilai = $nilai[0]->angka_kredit ?? '-';
        }

        return strval($nilai);
    }
}
