<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiLogbook
{
    use AsAction;

    public function handle($idSub, $tgl, $idKegiatan)
    {

        $nilai = DB::select("SELECT a.angka_kredit FROM pkb_penilaian_peserta a
                JOIN pkb_kegiatan_penyelenggara b ON a.id_kegiatan = b.uuid 
                WHERE a.id_sub_bidang = :idSub
                AND a.nik = :nik
                AND b.start_kegiatan > :tgl
                AND b.uuid = :idKegiatan", [
                    'idSub' => $idSub,
                    'nik' => Auth::user()->nik,
                    'tgl' => $tgl,
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
