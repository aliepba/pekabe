<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\VerifikasiKegiatan\GetPengesahan;
use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;

class PengesahanController extends Controller
{
    public function index(){
        return view('pages.pengesahan.index', GetPengesahan::run());
    }

    public function detail($uuid){
        return view('pages.pengesahan.detail', GetDetailPengesahan::run($uuid));
    }

    public function store(Request $request){

    }
}
