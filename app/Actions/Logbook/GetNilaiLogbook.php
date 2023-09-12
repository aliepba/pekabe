<?php

namespace App\Actions\Logbook;

use App\Models\Pengembangan\PenilaianAPI;
use App\Models\PenilaianPeserta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNilaiLogbook
{
    use AsAction;

    public function handle($idSub, $tgl, $idKegiatan, $idUnsur)
    {
        $nik = Auth::user()->nik;

        $nilaiPeserta = PenilaianPeserta::join('pkb_kegiatan_penyelenggara as b', 'pkb_penilaian_peserta.id_kegiatan', '=', 'b.uuid')
            ->where('pkb_penilaian_peserta.id_sub_bidang', $idSub)
            ->where('pkb_penilaian_peserta.nik', $nik)
            ->where('pkb_penilaian_peserta.created_at', '=', $tgl)
            ->where('pkb_penilaian_peserta.id_unsur', $idUnsur)
            ->where('b.uuid', $idKegiatan)
            ->select('pkb_penilaian_peserta.angka_kredit')
            ->first();

        $nilaiApi = PenilaianAPI::join('pkb_kegiatan_api as b', 'pkb_penilaian_api.id_kegiatan', '=', 'b.uuid')
            ->where('pkb_penilaian_api.id_sub_bidang', $idSub)
            ->where('pkb_penilaian_api.nik', $nik)
            ->where('pkb_penilaian_api.created_at', '>=', $tgl)
            ->where('pkb_penilaian_api.id_unsur', $idUnsur)
            ->where('b.uuid', $idKegiatan)
            ->select('pkb_penilaian_api.angka_kredit')
            ->first();


        if (!$nilaiPeserta && !$nilaiApi) {
            $nilai = '-';
        } else {
            $nilai = $nilaiPeserta ? $nilaiPeserta->angka_kredit : $nilaiApi->angka_kredit;
        }

        return strval($nilai);
    }
}
