<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class TenagaAhli
{
    use AsAction;

    public function handle($nik)
    {
        return [
            'data' => DB::select("SELECT
            a.`id_personal` AS NIK,
            a.`Nama`,
            b.`id_sub_bidang`,
            f.`Deskripsi` AS des_sub_klas,
            e.`Deskripsi_ahli` AS kualifikasi,
            b.`Tgl_proses` AS tanggal_cetak,
            c.`Nama` AS asosiasi,
            d.`Nama` AS Provinsi_registrasi
          FROM
            personal a
            JOIN  tk_registrasi_history b ON a.`id_personal` = b.`ID_Personal`
            JOIN personal_profesi_ta_detail c ON b.`ID_Asosiasi_profesi` = c.`ID_Asosiasi_Profesi`
            JOIN propinsi d ON b.`Propinsi` = d.`ID_Propinsi`
            JOIN `kualifikasi_profesi` e ON b.`id_Kualifikasi_profesi` = e.`ID_Kualifikasi_Profesi`
            JOIN `sub_bidang_keahlian_kbli` f ON b.`id_sub_bidang` = f.`ID_Sub_Bidang_Keahlian`
          WHERE
            b.`id_status` = '4'
            AND a.`id_personal` = '$nik'
          GROUP BY
            NIK,
            id_sub_bidang
            ")
        ];
    }
}
