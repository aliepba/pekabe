<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\DetailInstansi;
use Illuminate\Http\Request;
use App\Models\PerbaikanPersyaratan;
use App\Actions\Kegiatan\GetKegiatan;
use App\Services\Kegiatan\KegiatanService;
use App\Services\Perbaikan\PerbaikanService;
use App\Http\Resources\Kegiatan\KegiatanCollection;

class VerifikasiKegiatanController extends Controller
{

    private $perbaikanService, $kegiatanService;

    public function __construct(PerbaikanService $perbaikanService, KegiatanService $kegiatanService)
    {
        $this->perbaikanService = $perbaikanService;
        $this->kegiatanService = $kegiatanService;
        $this->middleware('IsLPJK')->only('list');
    }

    public function list()
    {
        $this->authorize('list-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.list', [
            'data' => Kegiatan::with(['validator'])->where('status_permohonan_kegiatan', 'SUBMIT')->get()
        ]);
    }

    public function detail($uuid)
    {
        $this->authorize('detail-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.detail', [
            'data' => Kegiatan::with(['validator'])->where('uuid', $uuid)->first()
        ]);
    }

    public function apt(){
        $this->authorize('list-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.all', [
            'data' => Kegiatan::with(['validator'])->where('status_permohonan_kegiatan', 'SUBMIT')->get()
        ]);
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
}
