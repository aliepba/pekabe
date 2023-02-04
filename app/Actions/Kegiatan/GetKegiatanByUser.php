<?php

namespace App\Actions\Kegiatan;

use App\models\SubPenyelenggara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetKegiatanByUser
{
    use AsAction;

    public function handle():array
    {
        $subUser = SubPenyelenggara::where('user_id', Auth::user()->id)->get('id');
        return [
            'kegiatan' => DB::select("SELECT
            uuid,
            nama_kegiatan,
            status_permohonan_kegiatan,
            tgl_pengajuan,
            start_kegiatan,
            end_kegiatan,
            subklasifikasi,
            Nama,
            is_verifikasi,
            tgl_penilaian
        FROM (
        SELECT
            a.uuid,
            a.nama_kegiatan,
            a.status_permohonan_kegiatan,
            a.tgl_pengajuan,
            a.start_kegiatan,
            a.end_kegiatan,
            a.subklasifikasi,
            b.Nama,
            a.is_verifikasi,
	        a.tgl_penilaian
        FROM pkb_kegiatan_penyelenggara a
        JOIN personal_profesi_ta_detail b on a.penilai = b.ID_Asosiasi_Profesi
        WHERE a.user_id = '". Auth::user()->id . "'
        UNION
        SELECT
            a.uuid,
            a.nama_kegiatan,
            a.status_permohonan_kegiatan,
            a.tgl_pengajuan,
            a.start_kegiatan,
            a.end_kegiatan,
            a.subklasifikasi,
            b.Nama,
            a.is_verifikasi,
	        a.tgl_penilaian
        FROM pkb_kegiatan_penyelenggara a
        JOIN personal_profesi_ta_detail b on a.penilai = b.ID_Asosiasi_Profesi
        JOIN pkb_users d on a.user_id  = d.id
        JOIN pkb_penanggung_jawab_pkb x on d.email = x.email
        JOIN pkb_detail_instansi y on a.penyelenggara_lain = y.id
        WHERE a.status_permohonan_kegiatan IN ('SUBMIT', 'APPROVE')
        UNION
        SELECT
            a.uuid,
            a.nama_kegiatan,
            a.status_permohonan_kegiatan,
            a.tgl_pengajuan,
            a.start_kegiatan,
            a.end_kegiatan,
            a.subklasifikasi,
            b.Nama,
            a.is_verifikasi,
	        a.tgl_penilaian
        FROM pkb_kegiatan_penyelenggara a
        JOIN personal_profesi_ta_detail b on a.penilai = b.ID_Asosiasi_Profesi
        WHERE a.user_id in ('". $subUser ."')
        ) q")
        ];
    }
}
