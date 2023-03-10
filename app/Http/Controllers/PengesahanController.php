<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Penilaian\PenilaianService;
use App\Actions\VerifikasiKegiatan\GetPengesahan;
use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;

class PengesahanController extends Controller
{

    private $penilaianService;

    public function __construct(PenilaianService $penilaianService){
        $this->penilaianService = $penilaianService;
    }

    public function index(){
        return view('pages.pengesahan.index', GetPengesahan::run());
    }

    public function detail($uuid){
        return view('pages.pengesahan.detail', GetDetailPengesahan::run($uuid));
    }

    public function sah(Request $request, $uuid){
        $this->penilaianService->pengesahan($request, $uuid);
        return redirect(route('pengesahan.index'))->with('success', 'Kegiatan Sudah Disahkan');
    }
}
