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

        $regular = DB::select("SELECT
                    id,
                    uuid,
                    nama_kegiatan,
                    start_kegiatan,
                    end_kegiatan,
                    jenis_kegiatan,
                    id_unsur,
                    nama_sub_unsur as unsur_kegiatan,
                    metode_kegiatan,
                    tingkat_kegiatan,
                    is_verifikasi,
                    ak
                    from (
                    select 
                        b.id,
                        b.uuid,
                        b.nama_kegiatan,
                        b.start_kegiatan ,
                        b.end_kegiatan,
                        a.id_unsur,
                        b.jenis_kegiatan,
                        c.nama_sub_unsur ,
                        case
                            when a.is_metode is null then '-'
                            when a.is_metode = 1 then 'Tatap Muka'
                            else 'Daring'
                        end as metode_kegiatan,
                        b.tingkat_kegiatan,
                        b.is_verifikasi,
                        a.angka_kredit as ak
                    from pkb_penilaian_peserta a
                    join pkb_kegiatan_penyelenggara b on a.id_kegiatan = b.uuid
                    join pkb_sub_unsur_kegiatan c on a.id_unsur  = c.id
                    where a.nik = '". Auth::user()->nik ."'
                    union
                    select
                        x.id,
                        x.uuid,
                        x.nama_kegiatan,
                        x.start_kegiatan,
                        x.end_kegiatan,
                        x.jenis_kegiatan,
                        x.id_unsur_kegiatan as id_unsur,
                        y.nama_sub_unsur ,
                        x.metode_kegiatan,
                        x.tingkat_kegiatan,
                        x.is_verified,
                        z.angka_kredit as ak
                    from pkb_kegiatan_unverified x
                    join pkb_sub_unsur_kegiatan y on x.id_unsur_kegiatan  = y.id
                    join pkb_penilaian_kegiatan z on x.uuid = z.uuid
                    where x.user_id = '". Auth::user()->id ."') a
                    ");

    $pengembangan = DB::SELECT("SELECT 
                        b.id,
                        b.uuid ,
                        b.nama_kegiatan ,
                        b.start_kegiatan,
                        b.end_kegiatan ,
                        b.jenis_kegiatan,
                        a.id_unsur,
                        c.nama_sub_unsur as unsur_kegiatan,
                        d.metode as metode_kegiatan,
                        b.tingkat_kegiatan ,
                        d.is_sah as is_verifikasi,
                        a.angka_kredit 
                    FROM pkb_penilaian_api a
                    JOIN pkb_kegiatan_api b ON a.id_kegiatan = b.uuid
                    JOIN pkb_sub_unsur_kegiatan c ON a.id_unsur = c.id 
                    JOIN pkb_peserta_api d ON a.id_kegiatan = d.id_kegiatan 
                    WHERE a.nik = '". Auth::user()->nik ."' GROUP BY b.uuid");

        return [
            'kegiatan' => array_merge($regular, $pengembangan)
        ];
    }
}
