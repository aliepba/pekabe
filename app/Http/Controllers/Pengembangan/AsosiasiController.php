<?php

namespace App\Http\Controllers\Pengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembangan\Kegiatan;

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
}
