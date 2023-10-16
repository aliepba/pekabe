<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Actions\Kegiatan\GetKegiatan;
use App\Services\Kegiatan\KegiatanService;
use App\Actions\VerifikasiKegiatan\GetAll;
use App\Actions\VerifikasiKegiatan\GetDetailKegiatan;
use App\Actions\VerifikasiKegiatan\GetByApt;
use App\Exports\KegiatanExport;
use App\Services\Log\LogService;
use App\Services\Perbaikan\PerbaikanService;
use Maatwebsite\Excel\Facades\Excel;

class VerifikasiKegiatanController extends Controller
{

    private $perbaikanService, $kegiatanService, $logError;

    public function __construct(PerbaikanService $perbaikanService, KegiatanService $kegiatanService, LogService $logService)
    {
        $this->perbaikanService = $perbaikanService;
        $this->kegiatanService = $kegiatanService;
        $this->logError = $logService;
        $this->middleware('IsLPJK')->only('list');
    }

    public function list()
    {
        $this->authorize('list-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.list', GetAll::run());
    }

    public function detail($uuid)
    {   
        $this->authorize('detail-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.detail', GetDetailKegiatan::run($uuid));
    }

    public function apt(){
        $this->authorize('list-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.byApt', GetByApt::run());
    }

    public function updateStatus(Request $request){
        $this->authorize('status-permohonan-kegiatan', Kegiatan::class);
        $this->kegiatanService->verifikasi($request);
        return redirect()->route('list.kegiatan')->with('success', 'Permohonan kegiatan berhasil di update');
    }

    public function detailKegiatan($id){
        $data = Kegiatan::find($id);
        return response()->json($data);
    }

    public function setuju(){
        return view('pages.verifikasi-kegiatan.setuju', GetKegiatan::run());
    }

    public function tolak(){
        return view('pages.verifikasi-kegiatan.tolak', GetKegiatan::run());
    }

    public function addKomen(Request $request)
    {
        $this->perbaikanService->addKomen($request);
    }

    public function export(){
        return Excel::download(new KegiatanExport, 'kegiatan.xlsx');
    }
}
