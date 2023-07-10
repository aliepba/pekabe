<?php

namespace App\Http\Controllers\Pengembangan;

use App\Http\Controllers\Controller;
use App\Models\Pengembangan\Kegiatan;
use App\Models\Pengembangan\PesertaAPI;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(){
        return view('pages.pengembangan.index', [
            'data' => Kegiatan::with(['asosiasi'])->get()
        ]);
    }

    public function detail($uuid){
        return view('pages.pengembangan.detail', [
            'data' => Kegiatan::with(['asosiasi', 'laporan', 'peserta', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first()
        ]);
    }
}
