<?php

namespace App\Http\Controllers\Pengembangan;

use App\Http\Controllers\Controller;
use App\Models\Pengembangan\Kegiatan;
use App\Services\Log\LogService;
use App\Services\Penilaian\PenilaianService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{

    private $penilaianService;
    private $logService;

    public function __construct(PenilaianService $penilaianService, LogService $logService)
    {
        $this->penilaianService = $penilaianService;
        $this->logService = $logService;
    }

    public function index(){
        return view('pages.pengembangan.index', [
            'data' => Kegiatan::with(['asosiasi'])->get()
        ]);
    }

    public function detail($uuid){
        $data = Kegiatan::with(['asosiasi', 'laporan', 'peserta', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first();
        if(!$data){return redirect(route('error.page'));}
        return view('pages.pengembangan.detail', [
            'data' => $data
        ]);
    }
    
    public function pengesahan(Request $request, $uuid){
        try {
            $this->penilaianService->penilaianAPI($request, $uuid);
            return redirect(route('pengembangan.index'))->with('success', 'Kegiatan Berhasil disahkan');
        } catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }
}
