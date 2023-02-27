<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRekapExport
{
    use AsAction;

    public function handle($subBidang):array
    {
        $rekap = DB::select("SELECT SUM(prakiraan_skpk) as rekap
                FROM log_kegiatan_pkb
                WHERE id_personal= ('". Auth::user()->nik ."')
                AND id_sub_bidang = '". $subBidang ."'
                ")[0];

        $kegiatan = DB::select("SELECT * FROM log_kegiatan_pkb
                    WHERE id_personal= ('". Auth::user()->nik ."')
                    AND id_sub_bidang = '". $subBidang ."'
                    ");

        $data = DB::select("SELECT
                            '1' AS aktif,
                            a.`id_personal` AS NIK,
                            a.`Nama`,
                            b.`id_sub_bidang`,
                            f.`Deskripsi` AS des_sub_klas,
                            e.`Deskripsi_ahli` AS kualifikasi,
                            b.`Tgl_proses` AS tanggal_cetak,
                            c.`Nama` AS asosiasi,
                            d.`Nama` AS Provinsi_registrasi
                        FROM
                            personal a,
                            tk_registrasi_history b,
                            personal_profesi_ta_detail c,
                            propinsi d,
                            `kualifikasi_profesi` e,
                            `sub_bidang_keahlian_kbli` f
                        WHERE
                            a.`id_personal` = b.`ID_Personal`
                            AND b.`ID_Asosiasi_profesi` = c.`ID_Asosiasi_Profesi`
                            AND b.`Propinsi` = d.`ID_Propinsi`
                            AND b.`id_sub_bidang` = f.`ID_Sub_Bidang_Keahlian`
                            AND b.`id_status` = '4'
                            AND b.`id_Kualifikasi_profesi` = e.`ID_Kualifikasi_Profesi`
                            AND a.`id_personal` IN ('". Auth::user()->nik ."')
                            AND b.id_sub_bidang = '". $subBidang ."'
                        GROUP BY
                            b.`ID_Personal`,
                            b.`id_sub_bidang`")[0];

        return [
            'rekap' => $rekap,
            'data' => $data,
            'kegiatan' => $kegiatan
        ];
    }
}
