<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DetailInstansi;
use App\Models\MtSubUnsurKegiatan;
use App\Models\MtAsosasiProfesiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PreferensiController extends Controller
{
    public function getKabKota(Request $request){
        $kabKota =  DB::table('kabupaten_dagri')
                        ->where('id_propinsi_dagri',  $request->id_propinsi_dagri)
                        ->pluck('id_kabupaten_dagri', 'nama_kabupaten_dagri');

        return response()->json($kabKota);
    }

    public function getAsosiasiProfesi(Request $request){
        $detail = DB::table('personal_profesi_ta_detail')
                    ->where('ID_Asosiasi_Profesi',  $request->id_asosiasi_profesi)
                    ->first();

        return response()->json($detail);
    }

    public function getAsosiasiBU(Request $request){
        $detail = DB::table('bu_asosiasi_detail')
                        ->where('ID_Asosiasi_BU', $request->id_asosiasi_bu)
                        ->first();

        return response()->json($detail);
    }

    public function showInstansi($id){
        $data = DetailInstansi::with(['penanggungjawab', 'provinsi', 'kabKota'])->find($id);
        return response()->json($data);
    }

    public function unsurKegiatan(Request $request){
        $unsur = MtSubUnsurKegiatan::where('id_unsur_kegiatan', $request->id)->pluck('id','nama_sub_unsur');

        return response()->json($unsur);
    }

    public function validator(Request $request){
        $subklas = explode(',', $request->subklas);
        $arraySub = array();
        $arrayKlas = array();
        $sub = DB::table('lsp_subklasifikasi')
                    ->whereIn('subklasifikasi', $subklas)
                    ->get();

        foreach($sub as $item){
            array_push($arraySub, $item->id_klasifikasi);
        }

        $klas = DB::table('lsp_klasifikasi')
                    ->whereIn('id_klasifikasi', $arraySub)
                    ->get();

        foreach($klas as $data){
            array_push($arrayKlas, $data->klasifikasi);
        }

        $apt = DB::table('pkb_personal_profesi_ta_detail')
                    ->where('Terakreditasi', '=' , '1')
                    ->whereIn('klasifikasi', $arrayKlas)
                    ->pluck('ID_Asosiasi_Profesi', 'Nama_Lengkap', 'Nama');

        return response()->json($apt);
    }

    public function markNotif(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request){
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
