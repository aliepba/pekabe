<?php

namespace App\Http\Controllers;

use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;

class IndikatorController extends Controller
{
    public function index(){
        //jumlah
        $TotalInstansiSetuju = DetailInstansi::whereNull('tgl_proses')->where('status_permohonan', 'APPROVE')->count();
        
        $TotalkegiatanSetuju = Kegiatan::whereNotIn('status_permohonan_kegiatan', ['TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN'])->count();
        $TotalunsurSetuju = DB::table('pkb_unsur_kegiatan_penyelenggara')
                                ->join('pkb_kegiatan_penyelenggara', 'pkb_unsur_kegiatan_penyelenggara.id_kegiatan', '=', 'pkb_kegiatan_penyelenggara.uuid')
                                ->whereNotIn('status_permohonan_kegiatan', ['PERBAIKAN', 'OPEN', 'SUBMIT', 'TOLAK'])
                                ->count('pkb_unsur_kegiatan_penyelenggara.id');
        $totalLain = DB::SELECT("SELECT SUM(jumlah) AS jumlah FROM (
                                SELECT count(a.id) AS jumlah FROM pkb_kegiatan_penyelenggara a
                                where status_permohonan_kegiatan IN ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN')
                                union 
                                SELECT count(a.id) AS jumlah FROM pkb_kegiatan_penyelenggara_lain a
                                join pkb_kegiatan_penyelenggara b ON a.id_kegiatan = b.uuid 
                                where b.status_permohonan_kegiatan IN ('TOLAK', 'OPEN', 'SUBMIT', 'PERBAIKAN')
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

        return view('pages.indikator.index', compact('akun', 'unsurSetuju', 'TotalInstansiSetuju', 'totalLain','TotalkegiatanSetuju', 'TotalunsurSetuju', 'TotalunsurPelaporan'));
    }
}
