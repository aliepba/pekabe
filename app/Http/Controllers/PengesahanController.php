<?php

namespace App\Http\Controllers;

use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;
use App\Actions\VerifikasiKegiatan\GetPengesahan;
use Illuminate\Http\Request;

class PengesahanController extends Controller
{
    public function index(){
        return view('pages.pengesahan.index', GetPengesahan::run());
    }

    public function detail($uuid){
        return view('pages.pengesahan.detail', GetDetailPengesahan::run($uuid));
    }
}
