<?php

namespace App\Http\Controllers\Pengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembangan\Kegiatan;
use Illuminate\Support\Facades\Http;

class AsosiasiController extends Controller
{
    public function index(){
        return view('pages.pengembangan.asosiasi.index', [
            'data' => Kegiatan::with(['asosiasi'])->get()
        ]);
    }

    public function detail($uuid){
        return view('pages.pengembangan.asosiasi.detail', [
            'data' => Kegiatan::with(['asosiasi', 'laporan', 'peserta', 'unsurKegiatan', 'unsurKegiatan.unsur', 'peserta.subUnsur'])->where('uuid', $uuid)->first()
        ]);
    }

    public function detailApi($uuid){
        $token = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxfQ.GL0GdGvzcw0uA2aGl96jBZXWLsKuXP_jTykJPLJeuuI";
        $url="https://lisensijakon.pu.go.id/api-pkb/api/v1/kegiatan-detail?id_kegiatan=".$uuid;

        $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ])->get($url);

        $data = json_decode($response, true);
        
        return response()->json($data);
    }
}
