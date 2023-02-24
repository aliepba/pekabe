<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRekapSKPK
{
    use AsAction;

    public function handle()
    {
        $data = DB::select("SELECT  a.`nik`,a.nama,a.`id_jabatan_kerja` AS id_sub_bidang,a.`jabatan_kerja` AS des_sub_klas,a.`jenjang` AS kualifikasi,a.`tanggal_ditetapkan` AS tanggal_cetak,a.`asosiasi`,a.`propinsi` AS provinsi_registrasi
            FROM lsp_pencatatan a
            LEFT JOIN lsp_personal b ON a.`id_izin`=b.id_izin
            WHERE a.`nik`= '". Auth::user()->nik ."' AND a.final_at IS NOT NULL AND valid='1' HAVING MAX(a.`id`)
            UNION
            SELECT
              nik,
              nama,
              id_sub_bidang,
              des_sub_klas,
              kualifikasi,
              tanggal_cetak,
              asosiasi,
              provinsi_registrasi
            FROM
              (
                SELECT
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
                GROUP BY
                  b.`ID_Personal`,
                  b.`id_sub_bidang`
                UNION
                SELECT
                  '0' AS aktif,
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
                  (
                    SELECT
                      id_hapus,
                      id_personal,
                      id_sub_bidang,
                      id_asosiasi_profesi,
                      id_kualifikasi_profesi,
                      tgl_proses,
                      propinsi,
                      id_unit_sertifikasi
                    FROM
                      tk_registrasi_history_hapus
                    WHERE
                      id_hapus IN(
                        SELECT
                          MAX(id_hapus) AS id
                        FROM
                          tk_registrasi_history_hapus
                        WHERE
                          id_status = '4'
                          AND id_personal IN ('". Auth::user()->nik ."')
                        GROUP BY
                          id_sub_bidang
                      )
                  ) b,
                  personal_profesi_ta_detail c,
                  propinsi d,
                  `kualifikasi_profesi` e,
                  `sub_bidang_keahlian_kbli` f
                WHERE
                  a.`id_personal` = b.`ID_Personal`
                  AND b.`ID_Asosiasi_profesi` = c.`ID_Asosiasi_Profesi`
                  AND b.`Propinsi` = d.`ID_Propinsi`
                  AND b.`id_sub_bidang` = f.`ID_Sub_Bidang_Keahlian`
                  AND b.`id_Kualifikasi_profesi` = e.`ID_Kualifikasi_Profesi`
                GROUP BY
                  b.`ID_Personal`,
                  b.`id_sub_bidang`
              ) q
            GROUP BY
              nik,
              id_sub_bidang
              ;
            ");

            $skpk = array();

            foreach($data as $item){
                $nilai = DB::select("SELECT SUM(prakiraan_skpk) as rekap
                        FROM log_kegiatan_pkb
                        WHERE id_personal= ('". Auth::user()->nik ."')
                        AND id_sub_bidang = '". $item->id_sub_bidang ."'
                        ")[0];

                $new_item = array(
                    'id_sub_bidang' => $item->id_sub_bidang,
                    'des_sub_klas' => $item->des_sub_klas,
                    'kualifikasi' => $item->kualifikasi,
                    'nilai_skpk' => $nilai->rekap
                );

                array_push($skpk, $new_item);
            }

            return [
                'skpk' => $skpk
            ];
    }
}
