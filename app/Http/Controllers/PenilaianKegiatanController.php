<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Penilaian\PenilaianService;
use App\Actions\VerifikasiKegiatan\GetPenilaian;
use App\Actions\VerifikasiKegiatan\GetDetailPenilaian;

class PenilaianKegiatanController extends Controller
{

    private $penilaianService;

    public function __construct(PenilaianService $penilaianService){
        $this->PenilaianService = $penilaianService;
    }

    public function index(){
        return view('pages.penilaian-kegiatan.index', GetPenilaian::run());
    }

    public function detail($uuid){
        return view('pages.penilaian-kegiatan.detail', GetDetailPenilaian::run($uuid));
    }

    public function store(Request $request)
    {
        $this->PenilaianService->penilaianValidator($request);
        return redirect(route('penilaian.index'))->with('success', 'berhasil dinilai');
    }
}
