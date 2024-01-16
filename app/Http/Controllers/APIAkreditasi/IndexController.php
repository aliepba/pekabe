<?php

namespace App\Http\Controllers\APIAkreditasi;

use App\Http\Controllers\Controller;
use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function getKegiatanProfesi($idAsosiasi)
    {   
        try{
            $user = User::where('jenis_penyelenggara', 2)
                        ->where('id_asosiasi', $idAsosiasi)->get();

            $usersId = $user->pluck('id')->toArray();

            $penyelenggara = DetailInstansi::where('jenis', 2)
                                            ->where('penyelenggara', $idAsosiasi)
                                            ->first();
                                            
            $penyelenggaraId = $penyelenggara == null ? 0 : $penyelenggara->id;
            
            $kolab = DB::table('pkb_kegiatan_penyelenggara_lain')
                        ->join('pkb_kegiatan_penyelenggara', 'pkb_kegiatan_penyelenggara_lain.id_kegiatan', '=', 'pkb_kegiatan_penyelenggara.uuid')
                        ->whereNotIn('pkb_kegiatan_penyelenggara.status_permohonan_kegiatan', ['TOLAK', 'OPEN'])
                        ->where('pkb_kegiatan_penyelenggara_lain.id_penyelenggara', $penyelenggaraId)
                        ->select(  
                        'pkb_kegiatan_penyelenggara.uuid',
                        'pkb_kegiatan_penyelenggara.nama_kegiatan')
                        ->get()->toArray();

            if(!empty($usersId)){
                    $kegiatan = DB::table('pkb_kegiatan_penyelenggara')
                    ->whereNotIn('status_permohonan_kegiatan', ['TOLAK', 'OPEN'])
                    ->whereIn('user_id', $usersId)
                    ->select(
                        'uuid',
                        'nama_kegiatan'
                    )
                    ->get()->toArray();
                    $data = array_merge($kegiatan, $kolab);
            }else{
                $kegiatan = [];
                $data = array_merge($kegiatan, $kolab);
            }



        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } 

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getKegiatanBU($idAsosiasi)
    {   
        try{
            $user = User::where('jenis_penyelenggara', 3)
                        ->where('id_asosiasi', $idAsosiasi)->get();
                        
            $usersId = $user->pluck('id')->toArray();

            $penyelenggara = DetailInstansi::where('jenis', 3)
                                            ->where('penyelenggara', $idAsosiasi)
                                            ->first();
                                            
            $penyelenggaraId = $penyelenggara == null ? 0 : $penyelenggara->id;
            
            $kolab = DB::table('pkb_kegiatan_penyelenggara_lain')
                        ->join('pkb_kegiatan_penyelenggara', 'pkb_kegiatan_penyelenggara_lain.id_kegiatan', '=', 'pkb_kegiatan_penyelenggara.uuid')
                        ->whereNotIn('pkb_kegiatan_penyelenggara.status_permohonan_kegiatan', ['TOLAK', 'OPEN'])
                        ->where('pkb_kegiatan_penyelenggara_lain.id_penyelenggara', $penyelenggaraId)
                        ->select(  
                        'pkb_kegiatan_penyelenggara.uuid',
                        'pkb_kegiatan_penyelenggara.nama_kegiatan')
                        ->get()->toArray();

            if(!empty($usersId)){
                    $kegiatan = DB::table('pkb_kegiatan_penyelenggara')
                    ->whereNotIn('status_permohonan_kegiatan', ['TOLAK', 'OPEN'])
                    ->whereIn('user_id', $usersId)
                    ->select(
                        'uuid',
                        'nama_kegiatan'
                    )
                    ->get()->toArray();
                    $data = array_merge($kegiatan, $kolab);
            }else{
                $kegiatan = [];
                $data = array_merge($kegiatan, $kolab);
            }



        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } 

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function getDetail($idKegiatan){
        try{
            $kegiatan = Kegiatan::with(['peserta', 'laporan'])->where('uuid', $idKegiatan)->first();
            if(!$kegiatan){$kegiatan == null;}
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } 

        return response()->json([
            'status' => 'success',
            'data' => $kegiatan
        ]);

    }
}   
