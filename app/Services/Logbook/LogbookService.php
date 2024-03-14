<?php

namespace App\Services\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogbookService{

    public function getSertifikat($nik)
    {
        $data = DB::select("SELECT  a.`nik`,a.nama,a.`id_jabatan_kerja` AS id_sub_bidang,a.`jabatan_kerja` AS des_sub_klas,a.`jenjang` AS kualifikasi,a.`tanggal_ditetapkan` AS tanggal_cetak,a.`asosiasi`,a.`propinsi` AS provinsi_registrasi
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

        return $data;
    }

    public function AKKegiatanUtama($nik, $userId,$idSub, $tgl){
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
            SELECT sum(a.angka_kredit) as ak  FROM pkb_penilaian_peserta a
            JOIN pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            JOIN pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
            WHERE a.id_sub_bidang = '$idSub'
            AND c.jenis = 'Kegiatan Utama'
            AND a.nik  = '". $nik . "'
            UNION
            SELECT sum(b.angka_kredit) as ak FROM pkb_kegiatan_unverified a
            JOIN pkb_penilaian_kegiatan b on a.uuid = b.uuid
            JOIN pkb_sub_unsur_kegiatan c on a.id_unsur_kegiatan = c.id
            JOIN pkb_master_unsur_kegiatan d on c.id_unsur_kegiatan  = d.id
            WHERE d.jenis = 'Kegiatan Utama'
            AND user_id = '". $userId . "'
            AND start_kegiatan >= '$tgl'
            UNION
            SELECT sum(a.angka_kredit) as ak FROM pkb_penilaian_api a
            WHERE a.id_sub_bidang  = '$idSub'
            AND a.nik = '". $nik . "'
        ) as total")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;     
    }

    public function AKKegiatanPenunjang($nik, $userId, $idSub, $tgl){
        $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
            select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
            where a.id_sub_bidang = '$idSub'
            and c.jenis = 'Kegiatan Penunjang'
            and a.nik  = '$nik'
            union
            select sum(x.angka_kredit) from pkb_penilaian_kegiatan x
			join pkb_kegiatan_unverified w on x.uuid = w.uuid
			join pkb_sub_unsur_kegiatan y on w.id_unsur_kegiatan = y.id 
			join pkb_master_unsur_kegiatan z on y.id_unsur_kegiatan = z.id 
			where z.jenis = 'Kegiatan Penunjang'
			and w.user_id = '$userId'
            and start_kegiatan >= '$tgl'
        ) as total")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;
    }

    public function AKKegiatanSelainNonFormal($nik, $userId, $idSub, $tgl){
        $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
            select sum(a.angka_kredit) as ak from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            where b.id_unsur_kegiatan not in ('2')
            and a.id_sub_bidang = '$idSub'
            and a.nik = '$nik'
            union
            select sum(y.angka_kredit) from pkb_kegiatan_unverified x
			join pkb_penilaian_kegiatan y on x.uuid = y.uuid 
			join pkb_sub_unsur_kegiatan z on x.id_unsur_kegiatan = z.id 
			where z.id_unsur_kegiatan not in ('2')
			and x.user_id = '". Auth::user()->id . "'
            and start_kegiatan >= '$tgl'
            union
            SELECT SUM(a.angka_kredit) as ak FROM pkb_penilaian_api a
            WHERE a.id_sub_bidang  = '$idSub'
            AND a.nik  = '$userId'
            ) as total")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;
    }

    public function AKKegiatanNonFormal($idSub, $tgl){
        $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
            select sum(a.angka_kredit) as ak from pkb_penilaian_peserta a
            join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
            where b.id_unsur_kegiatan = 2
            and a.id_sub_bidang = '$idSub'
            and a.nik = '". Auth::user()->nik . "'
            union
            select sum(a.angka_kredit) as ak  from pkb_penilaian_kegiatan a
            join pkb_kegiatan_unverified b on a.uuid = b.uuid
            join pkb_sub_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
            where b.user_id = '". Auth::user()->id . "'
            and c.id_unsur_kegiatan = 2
            and start_kegiatan >= '$tgl'
        ) as total")[0];

        if(empty($sum)){
            $ak = 0;
        }

        if(!empty($sum)){
            $ak = $sum->ak;
        }

        return $ak;
    }
    
    public function NilaiTerverifikasi($idSub){
      $ak = 0;
      $nik = Auth::user()->nik;

      $sum = DB::SELECT("SELECT SUM(total.ak) as ak from (
                          SELECT SUM(a.angka_kredit) as ak
                              FROM pkb_penilaian_peserta a
                              WHERE a.id_sub_bidang = '$idSub'
                              AND a.nik = '$nik'
                          UNION 
                          SELECT SUM(a.angka_kredit) as ak FROM pkb_penilaian_api a
                          WHERE a.id_sub_bidang  = '$idSub'
                          AND a.nik  = '$nik'
                          ) as total")[0];

      return empty($sum) ? $ak : $ak = $sum->ak;
    }

    public function NilaiUnverified($tgl){
      $sum = DB::SELECT("SELECT sum(a.angka_kredit) as ak from pkb_penilaian_kegiatan a
      join pkb_kegiatan_unverified b on a.uuid = b.uuid
      where b.user_id = '". Auth::user()->id . "'
      and start_kegiatan >= '$tgl'
      ")[0];

      if(empty($sum)){
      $ak = 0;
      }

      if(!empty($sum)){
      $ak = $sum->ak;
      }

      return $ak;
    }

    public function nilaiKhusus($nik, $userId, $idSub, $tgl){
      $sum = DB::SELECT("SELECT sum(total.ak) as ak from (
        select sum(angka_kredit) as ak from pkb_penilaian_peserta a
        where a.id_sub_bidang  = '$idSub'
        and a.nik = '$nik'
        and a.is_sifat = 1
        union
        select sum(angka_kredit) as ak from pkb_penilaian_kegiatan x
        join pkb_kegiatan_unverified y on x.uuid = y.uuid
        where y.user_id = '$userId'
        and start_kegiatan >=  '$tgl'
      ) as total")[0];

      if(empty($sum)){
      $ak = 0;
      }

      if(!empty($sum)){
      $ak = $sum->ak;
      }

      return $ak;
    }

    public function nilaiUmum($idSub){
      $sum = DB::SELECT("SELECT sum(angka_kredit) as ak from pkb_penilaian_peserta a
        where a.id_sub_bidang  = '$idSub'
        and a.nik = '". Auth::user()->nik . "'
        and a.is_sifat = 0.8")[0];

        if(empty($sum)){
        $ak = 0;
        }

        if(!empty($sum)){
        $ak = $sum->ak;
        }

        return $ak;
    }

    public function nilaiAll($idSub, $tgl){

      $sum = DB::SELECT("SELECT SUM(total.ak) as ak FROM (
        select sum(a.angka_kredit) as ak  from pkb_penilaian_peserta a
        join pkb_sub_unsur_kegiatan b on a.id_unsur = b.id
        join pkb_master_unsur_kegiatan c on b.id_unsur_kegiatan = c.id
        where a.id_sub_bidang = '$idSub'
        and a.nik  = '". Auth::user()->nik . "'
        union
        select sum(angka_kredit) as ak from pkb_penilaian_kegiatan x
        join pkb_kegiatan_unverified y on x.uuid = y.uuid
        where y.user_id = '". Auth::user()->id . "'
        and start_kegiatan >= '$tgl'
      ) as total")[0];

      $pengembangan = DB::select("select sum(angka_kredit) as jml from pkb_penilaian_api ppa where nik = '". Auth::user()->nik . "' AND id_sub_bidang='$idSub'" )[0];

      if(empty($pengembangan)){
          $pengembangan = 0;
      }

      if(empty($sum)){
          $ak = 0 + $pengembangan;
      }

      if(!empty($sum)){
          $ak = $sum->ak + $pengembangan->jml;
      }

      return $ak;
    }

    public function AKTerverifikasi($nik){
      $ak = DB::select("SELECT SUM(distinct c.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
      JOIN pkb_unsur_kegiatan_penyelenggara b ON a.uuid = b.id_kegiatan
      JOIN pkb_peserta_kegiatan d ON a.uuid  = d.id_kegiatan
      JOIN pkb_penilaian_kegiatan c ON d.unsur_peserta  = c.id_unsur
      JOIN pkb_pelaporan_kegiatan ppk ON a.uuid = ppk.id_kegiatan
      WHERE a.is_verifikasi  = '1'
      AND ppk.status_laporan  = 'SUBMIT'
      AND d.nik_peserta IN ('$nik')
      ");
      $byValidasi = DB::select("SELECT SUM(DISTINCT b.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
      JOIN pkb_penilaian_validator b ON a.uuid = b.id_kegiatan
      JOIN pkb_peserta_kegiatan c ON a.uuid = c.id_kegiatan
      WHERE a.tgl_penilaian IS NOT NULL
      AND a.is_verifikasi = 1
      AND c.nik_peserta IN ('$nik')
      ");
      $utama =  DB::select("SELECT SUM(DISTINCT d.angka_kredit) AS angka_kredit FROM pkb_kegiatan_penyelenggara a
      JOIN pkb_pelaporan_kegiatan b ON a.uuid = b.id_kegiatan
      JOIN pkb_peserta_kegiatan c ON a.uuid = c.id_kegiatan
      JOIN pkb_penilaian_kegiatan d ON a.uuid  = d.uuid
      WHERE b.status_laporan = 'SUBMIT'
      AND a.is_verifikasi = '1'
      AND a.jenis_kegiatan in (1,2,3,4,5)
      AND c.nik_peserta IN ('$nik')
      ");

      return [
          'ak' => $ak,
          'byValidasi' => $byValidasi,
          'utama' => $utama
      ];
  }
}