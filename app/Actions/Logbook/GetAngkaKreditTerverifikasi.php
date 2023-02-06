<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAngkaKreditTerverifikasi
{
    use AsAction;

    public function handle():array
    {
        return [
            'ak' => DB::select("SELECT SUM(DISTINCT d.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
                                JOIN pkb_pelaporan_kegiatan b ON a.uuid = b.id_kegiatan
                                JOIN pkb_peserta_kegiatan c ON a.uuid = c.id_kegiatan
                                JOIN pkb_penilaian_kegiatan d ON a.uuid  = d.uuid
                                WHERE b.status_laporan = 'SUBMIT'
                                AND a.is_verifikasi = '1'
                                AND c.nik_peserta IN ('" .Auth::user()->nik. "')
                                "),
            'byValidasi' => DB::select("SELECT SUM(DISTINCT b.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
                                JOIN pkb_penilaian_validator b ON a.uuid = b.id_kegiatan
                                JOIN pkb_peserta_kegiatan c ON a.uuid = c.id_kegiatan
                                WHERE a.tgl_penilaian IS NOT NULL
                                AND a.is_verifikasi = 1
                                AND c.nik_peserta IN ('". Auth::user()->nik ."')
                                "),
            'utama' => DB::select("SELECT SUM(DISTINCT d.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
                                JOIN pkb_pelaporan_kegiatan b ON a.uuid = b.id_kegiatan
                                JOIN pkb_peserta_kegiatan c ON a.uuid = c.id_kegiatan
                                JOIN pkb_penilaian_kegiatan d ON a.uuid  = d.uuid
                                WHERE b.status_laporan = 'SUBMIT'
                                AND a.is_verifikasi = '1'
                                AND a.jenis_kegiatan in (1,2,3,4,5)
                                AND c.nik_peserta IN ('" .Auth::user()->nik. "')
                                ")
        ];
    }
}
