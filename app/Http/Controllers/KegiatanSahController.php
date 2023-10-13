<?php

namespace App\Http\Controllers;

use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;
use App\Actions\VerifikasiKegiatan\GetKegiatanSah;
use Illuminate\Http\Request;

class KegiatanSahController extends Controller
{
    public function index(){
        return view('pages.sah.index', GetKegiatanSah::run());
    }

    public function detail($uuid){
        return view('pages.sah.detail', GetDetailPengesahan::run($uuid));
    }
}
