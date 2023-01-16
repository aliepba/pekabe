<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\PerbaikanPersyaratan;
use App\Services\Kegiatan\KegiatanService;
use App\Services\Perbaikan\PerbaikanService;

class VerifikasiKegiatanController extends Controller
{

    private $perbaikanService, $kegiatanService;

    public function __construct(PerbaikanService $perbaikanService, KegiatanService $kegiatanService)
    {
        $this->perbaikanService = $perbaikanService;
        $this->kegiatanService = $kegiatanService;
    }

    public function list()
    {
        $this->authorize('list-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.list', [
            'data' => Kegiatan::with(['validator'])->where('penilai', 000)->where('status_permohonan_kegiatan', 'SUBMIT')->get()
        ]);
    }

    public function detail($uuid)
    {
        $this->authorize('detail-permohonan-kegiatan', Kegiatan::class);
        return view('pages.verifikasi-kegiatan.detail', [
            'data' => Kegiatan::with(['validator'])->where('uuid', $uuid)->first()
        ]);
    }


    public function updateStatus(Request $request){
        $this->authorize('status-permohonan-kegiatan', Kegiatan::class);
        $this->kegiatanService->verifikasi($request);
        return redirect()->route('list.kegiatan')->with('success', 'Permohonan berhasil di minta perbaikan');
    }

    public function detailKegiatan($id){
        $data = Kegiatan::find($id);
        return response()->json($data);
    }

    public function addKomen(Request $request)
    {
        $this->perbaikanService->addKomen($request);
    }
}
