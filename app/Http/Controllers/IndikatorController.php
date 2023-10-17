<?php

namespace App\Http\Controllers;

use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use App\Models\MtAsosiasiProfesi;
use Illuminate\Support\Facades\Redis;

class IndikatorController extends Controller
{

    public function index(){
        
        $TotalInstansiSetuju = DetailInstansi::whereNull('tgl_proses')->where('status_permohonan', 'APPROVE')->count();
        $TotalkegiatanSetuju = Kegiatan::whereNotIn('status_permohonan_kegiatan', ['TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN'])->count();
        $TotalunsurSetuju = DB::table('pkb_unsur_kegiatan_penyelenggara')
                                ->join('pkb_kegiatan_penyelenggara', 'pkb_unsur_kegiatan_penyelenggara.id_kegiatan', '=', 'pkb_kegiatan_penyelenggara.uuid')
                                ->whereNotIn('status_permohonan_kegiatan', ['PERBAIKAN', 'OPEN', 'SUBMIT', 'TOLAK'])
                                ->count('pkb_unsur_kegiatan_penyelenggara.id');
        $totalLain = DB::SELECT("SELECT SUM(jumlah) AS jumlah FROM (
                                SELECT count(a.id) AS jumlah FROM pkb_kegiatan_penyelenggara a
                                where status_permohonan_kegiatan NOT IN ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN')
                                union 
                                SELECT count(a.id) AS jumlah FROM pkb_kegiatan_penyelenggara_lain a
                                join pkb_kegiatan_penyelenggara b ON a.id_kegiatan = b.uuid 
                                where b.status_permohonan_kegiatan NOT IN ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN')
                                ) a");
        
        $TotalkegiatanPelaporan = Kegiatan::whereNotIn('status_permohonan_kegiatan', ['PERBAIKAN', 'OPEN', 'SUBMIT', 'TOLAK', 'APPROVE'])->count();
        $TotalunsurPelaporan = DB::table('pkb_unsur_kegiatan_penyelenggara')
                                ->join('pkb_kegiatan_penyelenggara', 'pkb_unsur_kegiatan_penyelenggara.id_kegiatan', '=', 'pkb_kegiatan_penyelenggara.uuid')
                                ->whereNotIn('status_permohonan_kegiatan', ['PERBAIKAN', 'OPEN', 'SUBMIT', 'TOLAK', 'APPROVE'])
                                ->count('pkb_unsur_kegiatan_penyelenggara.id');

        //chart
        $akun = DB::SELECT("select a.jenis AS jenis_penyelenggara, jumlah from 
                                (select a.jenis_penyelenggara as jenis from pkb_master_penyelenggara a) a 
                                left join 
                                (
                                select a.jenis_penyelenggara as jenis, count(b.id) as jumlah from pkb_master_penyelenggara a 
                                join pkb_detail_instansi b on a.id = b.jenis 
                                where b.status_permohonan = 'APPROVE'
                                group by b.jenis 
                                ) b on a.jenis = b.jenis");

        $unsurSetuju = DB::SELECT("select c.unsur_kegiatan as unsur, count(a.id_unsur) as jumlah from pkb_unsur_kegiatan_penyelenggara a
                                join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id 
                                join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                                join pkb_kegiatan_penyelenggara d on a.id_kegiatan = d.uuid
                                where d.status_permohonan_kegiatan not in ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN')
                                group by c.unsur_kegiatan 
                                order by c.id");

        $unsurPelaporan = DB::SELECT("select c.unsur_kegiatan as unsur, count(a.id_unsur) as jumlah from pkb_unsur_kegiatan_penyelenggara a
                                join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id 
                                join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
                                join pkb_kegiatan_penyelenggara d on a.id_kegiatan = d.uuid
                                where d.status_permohonan_kegiatan not in ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN', 'APPROVE')
                                group by c.unsur_kegiatan 
                                order by c.id");

        return view('pages.indikator.umum', compact('akun', 'unsurSetuju', 'TotalInstansiSetuju', 'totalLain','TotalkegiatanSetuju', 'TotalunsurSetuju', 'TotalunsurPelaporan', 'unsurPelaporan'));
    }

    public function khusus(){
        $asosiasi = DB::SELECT("SELECT 
        a.id_asosiasi,
        a.Terakreditasi,
        a.Nama ,
        a.Nama_Lengkap,
        b.jenjang7,
        c.jenjang8,
        d.jenjang9
        FROM (SELECT a.ID_Asosiasi_Profesi AS id_asosiasi , a.Terakreditasi , a.Nama , a.Nama_Lengkap FROM personal_profesi_ta_detail a WHERE a.ID_Asosiasi_Profesi NOT IN ('000', '001', '999')) a
        LEFT JOIN 
        (SELECT a.id_asosiasi, COUNT(*) AS jenjang7 FROM lsp_pencatatan a WHERE a.final_at IS NOT NULL AND a.valid='1' and a.jenjang = 7 GROUP BY a.id_asosiasi) b ON b.id_asosiasi = a.id_asosiasi
        LEFT JOIN 
        (SELECT a.id_asosiasi, COUNT(*) AS jenjang8 FROM lsp_pencatatan a WHERE a.final_at IS NOT NULL AND a.valid='1' and a.jenjang = 8 GROUP BY a.id_asosiasi) c ON c.id_asosiasi = a.id_asosiasi
        LEFT JOIN 
        (SELECT a.id_asosiasi, COUNT(*) AS jenjang9 FROM lsp_pencatatan a WHERE a.final_at IS NOT NULL AND a.valid='1' and a.jenjang = 9 GROUP BY a.id_asosiasi) d ON d.id_asosiasi = a.id_asosiasi
        ORDER BY a.id_asosiasi ASC");

        return view('pages.indikator.khusus', compact('asosiasi'));
    }
}
