<?php

namespace App\Http\Controllers;

use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use App\Models\MtAsosiasiProfesi;
use App\Models\PenilaianPeserta;
use App\Models\RekapSKK;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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

        $skpk = DB::SELECT("select a.jenjang, b.jumlah_50, c.jumlah_100, d.jumlah_150, e.jumlah_200 , f.jumlah_201, 
        COALESCE(b.jumlah_50, 0) + COALESCE(c.jumlah_100, 0) + COALESCE(d.jumlah_150, 0) + COALESCE(e.jumlah_200, 0) + COALESCE(f.jumlah_201, 0) AS jumlah_total
        from 
        (SELECT a.jenjang_id as jenjang FROM lsp_jabatan_kerja a
        left JOIN pkb_penilaian_peserta b ON b.id_sub_bidang = a.id_jabatan_kerja COLLATE utf8mb4_unicode_ci
        where a.jenjang_id in ('7','8', '9') group by a.jenjang_id) a 
        LEFT JOIN 
        (SELECT	
                b.jenjang_id as jenjang,
                COUNT(DISTINCT a.nik) AS jumlah_50
            FROM
                pkb_penilaian_peserta a
            LEFT JOIN
                lsp_jabatan_kerja b ON b.id_jabatan_kerja = a.id_sub_bidang COLLATE utf8mb4_unicode_ci
            WHERE
                b.jenjang_id in ('7', '8', '9')
            GROUP BY
                a.id_sub_bidang , b.jenjang_id 
            HAVING
                SUM(a.angka_kredit) <= 50) b on a.jenjang = b.jenjang
        LEFT JOIN(
        SELECT	
                b.jenjang_id as jenjang,
                COUNT(DISTINCT a.nik) AS jumlah_100
            FROM
                pkb_penilaian_peserta a
            LEFT JOIN
                lsp_jabatan_kerja b ON b.id_jabatan_kerja = a.id_sub_bidang COLLATE utf8mb4_unicode_ci
            WHERE
                b.jenjang_id in ('7', '8', '9')
            GROUP BY
                a.id_sub_bidang , b.jenjang_id 
            HAVING
                SUM(a.angka_kredit) > 50
                AND SUM(a.angka_kredit) <= 100
        ) c on a.jenjang = c.jenjang
        LEFT JOIN(
        SELECT	
                b.jenjang_id as jenjang,
                COUNT(DISTINCT a.nik) AS jumlah_150
            FROM
                pkb_penilaian_peserta a
            LEFT JOIN
                lsp_jabatan_kerja b ON b.id_jabatan_kerja = a.id_sub_bidang COLLATE utf8mb4_unicode_ci
            WHERE
                b.jenjang_id in ('7', '8', '9')
            GROUP BY
                a.id_sub_bidang , b.jenjang_id 
            HAVING
                SUM(a.angka_kredit) > 100
                AND SUM(a.angka_kredit) <= 150
        ) d on a.jenjang = d.jenjang
        LEFT JOIN(
        SELECT	
                b.jenjang_id as jenjang,
                COUNT(DISTINCT a.nik) AS jumlah_200
            FROM
                pkb_penilaian_peserta a
            LEFT JOIN
                lsp_jabatan_kerja b ON b.id_jabatan_kerja = a.id_sub_bidang COLLATE utf8mb4_unicode_ci
            WHERE
                b.jenjang_id in ('7', '8', '9')
            GROUP BY
                a.id_sub_bidang , b.jenjang_id 
            HAVING
                SUM(a.angka_kredit) > 150
                AND SUM(a.angka_kredit) <= 200
        ) e on a.jenjang = e.jenjang
        LEFT JOIN(
        SELECT	
                b.jenjang_id as jenjang,
                COUNT(DISTINCT a.nik) AS jumlah_201
            FROM
                pkb_penilaian_peserta a
            LEFT JOIN
                lsp_jabatan_kerja b ON b.id_jabatan_kerja = a.id_sub_bidang COLLATE utf8mb4_unicode_ci
            WHERE
                b.jenjang_id in ('7', '8', '9')
            GROUP BY
                a.id_sub_bidang , b.jenjang_id 
            HAVING
                SUM(a.angka_kredit) > 200
        ) f on a.jenjang = f.jenjang
                group by a.jenjang 
                order by a.jenjang asc");

        return view('pages.indikator.umum', compact('akun', 'skpk' ,'unsurSetuju', 'TotalInstansiSetuju', 'totalLain','TotalkegiatanSetuju', 'TotalunsurSetuju', 'TotalunsurPelaporan', 'unsurPelaporan'));
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

    public function rekapSKK()
    {
        $date = Carbon::now()->format('Y-m-d');
        $cek = RekapSKK::where('date', $date)->first();
        $resultArray = json_decode($cek->rekap, true);
        return view('pages.indikator.rekapitulasi-skk', compact('resultArray', 'cek'));
    }

    public function saveData(){
        $rekapAK = Cache::remember('all_nilai',1800, function () {
            return PenilaianPeserta::select('nik', 'id_sub_bidang', DB::raw('SUM(angka_kredit) as total_angka_kredit'))
            ->groupBy('nik', 'id_sub_bidang')
            ->get();
        });
    
        $data = [];
                
        foreach($rekapAK as $item){
            $getSKK = DB::SELECT("select jabatan_kerja , jenjang , year(tanggal_ditetapkan) as tahun 
                        from lsp_pencatatan lp where jenjang in(7,8,9) and valid = 1  and nik = '$item->nik' and id_jabatan_kerja='$item->id_sub_bidang'");
            
            if(!empty($getSKK)){
                array_push($data, [
                    'nik' => $item->nik,
                    'id_sub_bidang' => $item->id_sub_bidang,
                    'ak' => $item->total_angka_kredit,
                    'jenjang' => $getSKK[0]->jenjang,
                    'tahun_terbit' => $getSKK[0]->tahun,
                ]);
            }
        }

        $resultArray = [];

        foreach ($data as $entry) {
            $year = $entry["tahun_terbit"];
            $jenjang = $entry["jenjang"];
            $ak = $entry["ak"];
        
            if (!isset($resultArray[$year])) {
                $resultArray[$year] = [];
            }

            if (!isset($resultArray[$year][$jenjang])) {
                $resultArray[$year][$jenjang] = [
                    "below50" => 0,
                    "below100" => 0, 
                    "above100" => 0, 
                    "above150" => 0,
                    "above200" => 0
                ];
            }
            //cek angka kredit per jabatan kerja
            if (is_numeric($ak)) {
                if($ak < 50){
                    $resultArray[$year][$jenjang]["below50"]++;
                }

                if ($ak >= 50 && $ak <= 99) {
                    $resultArray[$year][$jenjang]["below100"]++;
                } 
                
                if($ak >= 100 && $ak <= 149){
                    $resultArray[$year][$jenjang]["above100"]++;
                }

                if($ak >= 150 && $ak <= 199){
                    $resultArray[$year][$jenjang]["above150"]++;
                }
                if($ak >= 200){
                    $resultArray[$year][$jenjang]["above200"]++;
                }  
            }
        }
        
        $date = Carbon::now()->format('Y-m-d');
        $cek = RekapSKK::where('date', $date)->first();

        DB::beginTransaction();
        if(!$cek){
            $rekap = new RekapSKK();
            $rekap->date = Carbon::now();
            $rekap->rekap = json_encode($resultArray);
            $rekap->save();
        }else{
            $cek->rekap = json_encode($resultArray);
            $cek->save();       
        }
        DB::commit();


        return response()->json('success');
    }
}
