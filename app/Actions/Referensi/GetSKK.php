<?php

namespace App\Actions\Referensi;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSKK
{
    use AsAction;

    public function handle($nik)
    {
        return [
            'skk' => DB::select("SELECT  a.`nik`,a.nama,a.`id_jabatan_kerja` AS id_sub_bidang,
            a.`jabatan_kerja` AS des_sub_klas,a.`jenjang` AS kualifikasi,a.`tanggal_ditetapkan` AS tanggal_cetak,
            a.`asosiasi`,a.`propinsi` AS provinsi_registrasi,
            a.subklasifikasi,
            a.klasifikasi
            FROM lsp_pencatatan a
            LEFT JOIN lsp_personal b ON a.`id_izin`=b.id_izin
            WHERE a.`nik`='$nik' AND a.final_at IS NOT NULL AND valid='1' and a.jenjang in('7','8','9')")
        ];
    }
}
