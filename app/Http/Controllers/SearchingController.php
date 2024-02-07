<?php

namespace App\Http\Controllers;

use App\Services\Log\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use helpers\MyHelper;
use App\Actions\Logbook\GetNilaiByIDSub;
use App\Models\Pengembangan\PenilaianAPI;
use App\Models\User;

class SearchingController extends Controller
{
    private $logService;

    public function __construct(LogService $logService)
    {  
       $this->logService = $logService; 
    }

    public function cekSkpk()
    {
        return view('pages.searching.nilaiByNik');
    }

    public function getSertifikat(Request $request){
        $nik = $request->nik;

        $sertifikat = DB::select("SELECT  a.`nik`,a.nama,a.`id_jabatan_kerja` AS id_sub_bidang,a.`jabatan_kerja` AS des_sub_klas,a.`jenjang` AS kualifikasi,a.`tanggal_ditetapkan` AS tanggal_cetak,a.`asosiasi`,a.`propinsi` AS provinsi_registrasi
        FROM lsp_pencatatan a
        LEFT JOIN lsp_personal b ON a.`id_izin`=b.id_izin
        WHERE a.`nik`='$nik' AND a.final_at IS NOT NULL AND valid='1' and a.jenjang in('7','8','9')
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
              AND left (b.id_sub_bidang, 2) in ('AA', 'AT')
              AND a.`id_personal` IN ('$nik')
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
                      AND id_personal = '$nik'
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
              AND left (b.id_sub_bidang, 2) in ('AA', 'AT')
            GROUP BY
              b.`ID_Personal`,
              b.`id_sub_bidang`
          ) q
        GROUP BY
          nik,
          id_sub_bidang
          ;
        ");

        if(empty($sertifikat)){
            return 'NODATA';
        }

        $data = [];
        $id = 0;
        $user = User::where('nik', $nik)->first();
        $id= !empty($user) ? $user->id : 0;
        foreach($sertifikat as $item){
        
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
            select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
            where a.id_sub_bidang = '$item->id_sub_bidang'
            and a.nik  = '". $nik . "'
            union
            select sum(angka_kredit) as ak from pkb_penilaian_kegiatan x
            join pkb_kegiatan_unverified y on x.uuid = y.uuid
            where y.user_id = '". $id . "'
            and start_kegiatan >= '$item->tanggal_cetak'
        ) as total")[0];

        $pengembangan = PenilaianAPI::where('nik', $nik)
                                      ->where('id_sub_bidang', $item->id_sub_bidang)
                                      ->sum('angka_kredit');
        

        if(empty($sum)){
            $ak = 0 + $pengembangan;
        }
                            
        if(!empty($sum)){
            $ak = $sum->ak + $pengembangan;
        }
                            

        array_push($data,
          [
              'nama' => $item->nama,
              'des_sub_klas' => $item->des_sub_klas,
              'nilai' => $ak
          ]);
        }

        return response()->json($data);

    }
}
