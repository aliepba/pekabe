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
                        a.id,
                        a.uuid ,
                        a.nama_kegiatan ,
                        a.start_kegiatan,
                        b.created_at AS start_kegiatan ,
                        b.created_at AS end_kegiatan ,
                        b.unsur AS id_unsur,
                        c.nama_sub_unsur AS unsur_kegiatan,
                        b.metode AS metode_kegiatan,
                        b.is_sah  AS tingkat_kegiatan ,
                        b.is_sah AS is_verifikasi,
                        c.nilai_skpk AS angka_kredit
                    FROM pkb_kegiatan_api a
                    JOIN pkb_peserta_api b ON a.uuid = b.id_kegiatan 
                    JOIN pkb_sub_unsur_kegiatan c ON c.id = b.unsur 
                    WHERE b.nik = '". Auth::user()->nik ."'");

        return [
            'kegiatan' => array_merge($regular, $pengembangan)
        ];
    }
}
