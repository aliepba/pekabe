<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Services\Penilaian\PenilaianService;
use App\Actions\VerifikasiKegiatan\GetPengesahan;
use App\Actions\VerifikasiKegiatan\GetDetailPengesahan;
use App\Models\Kegiatan;
use App\Services\Log\LogService;

class PengesahanController extends Controller
{

    private $penilaianService;
    private $logService;

    public function __construct(PenilaianService $penilaianService, LogService $logService){
        $this->penilaianService = $penilaianService;
        $this->logService = $logService;
    }

    public function index(){
        return view('pages.pengesahan.index', GetPengesahan::run());
    }

    public function detail($uuid){
        return view('pages.pengesahan.detail', GetDetailPengesahan::run($uuid));
    }

    public function sah(Request $request, $uuid){
        try{
            $this->penilaianService->pengesahan($request, $uuid);
            return redirect(route('pengesahan.index'))->with('success', 'Kegiatan Sudah Disahkan');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        }
    }

    public function ba($uuid){
        $data = Kegiatan::with(['unsurKegiatan', 'unsurKegiatan.unsur','user'])->where('uuid', $uuid)->first();
        if(!$data){return redirect(route('error.page'));}
        $pdf = PDF::loadview('pdf.ba-pengesahan', [
            'data' => $data
        ]);
        return $pdf->stream();
    }
}
