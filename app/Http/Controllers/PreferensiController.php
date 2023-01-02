<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailInstansi;
use Illuminate\Support\Facades\DB;

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
}
