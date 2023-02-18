<?php

namespace App\Actions\Kegiatan;

use App\Models\SubPenyelenggara;
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
        SELECT  a1.uuid,
            a1.nama_kegiatan,
            a1.status_permohonan_kegiatan,
            a1.tgl_pengajuan,
            a1.start_kegiatan,
            a1.end_kegiatan,
            a1.subklasifikasi,
            a1.Nama,
            a1.is_verifikasi,
	        a1.tgl_penilaian
        	FROM (
        SELECT  a.uuid,
            a.nama_kegiatan,
            a.status_permohonan_kegiatan,
            a.tgl_pengajuan,
            a.start_kegiatan,
            a.end_kegiatan,
            a.subklasifikasi,
            a.is_verifikasi,
            b.id_penyelenggara ,
            bb.Nama ,
	        a.tgl_penilaian from pkb_kegiatan_penyelenggara a
        JOIN pkb_kegiatan_penyelenggara_lain b on a.uuid = b.id_kegiatan
        JOIN personal_profesi_ta_detail bb on a.penilai = bb.ID_Asosiasi_Profesi
        WHERE a.status_permohonan_kegiatan IN ('SUBMIT', 'APPROVE')
        AND a.user_id = '". Auth::user()->id . "' ) as a1
        JOIN (
        SELECT b.id, b.nama_instansi from pkb_kegiatan_penyelenggara_lain a
        JOIN pkb_detail_instansi b on a.id_penyelenggara = b.id) b1 on a1.id_penyelenggara = b1.id
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
