<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class KegiatanTenagaAhli
{
    use AsAction;

    public function handle($nik, $id)
    {
        return [
            'kegiatan' => DB::select("SELECT nama_kegiatan,
            start_kegiatan,
            end_kegiatan,
            jenis_kegiatan,
            unsur_kegiatan,
            metode_kegiatan,
            tingkat_kegiatan,
            is_verifikasi
            FROM
            (
            SELECT b.nama_kegiatan,
                    b.start_kegiatan,
                    b.end_kegiatan,
                    xx.unsur_kegiatan as jenis_kegiatan,
                    x.nama_sub_unsur  as unsur_kegiatan,
                    b.metode_kegiatan ,
                    b.tingkat_kegiatan,
                    b.is_verifikasi
            FROM pkb_peserta_kegiatan a , pkb_kegiatan_penyelenggara b, pkb_sub_unsur_kegiatan x, pkb_master_unsur_kegiatan xx
            WHERE a.id_kegiatan = b.uuid
            AND b.unsur_kegiatan = x.id
            and b.jenis_kegiatan = xx.id
            AND a.nik_peserta in ('$nik')
            GROUP BY a.id_kegiatan
            UNION
            SELECT c.nama_kegiatan,
                    c.start_kegiatan,
                    c.end_kegiatan,
                    xx.unsur_kegiatan  as jenis_kegiatan,
                    y.nama_sub_unsur  as unsur_kegiatan,
                    c.metode_kegiatan,
                    c.tingkat_kegiatan,
                    c.is_verified as is_verifikasi
            FROM pkb_kegiatan_unverified c, pkb_sub_unsur_kegiatan y, pkb_master_unsur_kegiatan xx
            WHERE c.id_unsur_kegiatan = y.id
            AND c.jenis_kegiatan = xx.id
            AND c.user_id in ('$id')
            GROUP BY c.id
            UNION
            SELECT d.nama_kegiatan,
                    d.start_kegiatan,
                    d.end_kegiatan,
                    xx.unsur_kegiatan  as jenis_kegiatan,
                    z.nama_sub_unsur  as unsur_kegiatan,
                    d.metode_kegiatan,
                    d.tingkat_kegiatan,
                    d.is_verifikasi
            FROM pkb_old_kegiatan d, pkb_sub_unsur_kegiatan z, pkb_master_unsur_kegiatan xx
            WHERE d.sub_kegiatan = z.id
            AND d.jenis_kegiatan  = xx.id
            AND d.user_id in ('$id')
            GROUP BY d.id
            )p
            ")
        ];
    }
}
