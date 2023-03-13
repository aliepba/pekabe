<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Services\Penilaian\PenilaianService;
use App\Actions\VerifikasiKegiatan\GetPengesahan;
use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;
use App\Models\Kegiatan;

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

    public function ba($uuid){
        $pdf = PDF::loadview('pdf.ba-pengesahan', ['data' => Kegiatan::with(['unsurKegiatan', 'unsurKegiatan.unsur','user'])->where('uuid', $uuid)->first()]);
        return $pdf->stream();
    }
}
