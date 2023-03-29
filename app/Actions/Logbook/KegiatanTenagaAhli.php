<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class KegiatanTenagaAhli
{
    use AsAction;

    public function handle()
    {
        return [
            'kegiatan' => DB::select("SELECT
            nama_kegiatan,
            start_kegiatan,
            end_kegiatan,
            jenis_kegiatan,
            nama_sub_unsur as unsur_kegiatan,
            metode_kegiatan,
            tingkat_kegiatan,
            is_verifikasi,
            ak
            from (
            select b.nama_kegiatan,
                b.start_kegiatan ,
                b.end_kegiatan,
                b.jenis_kegiatan,
                c.nama_sub_unsur ,
                b.metode_kegiatan,
                b.tingkat_kegiatan,
                b.is_verifikasi,
                a.angka_kredit as ak
            from pkb_penilaian_peserta a
            join pkb_kegiatan_penyelenggara b on a.id_kegiatan = b.uuid
            join pkb_sub_unsur_kegiatan c on a.id_unsur  = c.id
            where a.nik = '". Auth::user()->nik ."'
            group by b.nama_kegiatan
            union
            select
                x.nama_kegiatan,
                x.start_kegiatan,
                x.end_kegiatan,
                x.jenis_kegiatan,
                y.nama_sub_unsur ,
                x.metode_kegiatan,
                x.tingkat_kegiatan,
                x.is_verified,
                z.angka_kredit as ak
            from pkb_kegiatan_unverified x
            join pkb_sub_unsur_kegiatan y on x.id_unsur_kegiatan  = y.id
            join pkb_penilaian_kegiatan z on x.uuid = z.uuid
            where x.user_id = '". Auth::user()->id ."'
            group by x.nama_kegiatan
        ) a
        ")
        ];
    }
}
