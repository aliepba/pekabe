<?php

namespace App\Http\Controllers\Pengembangan;

use App\Http\Controllers\Controller;
use App\Models\Pengembangan\Kegiatan;
use App\Services\Penilaian\PenilaianService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{

    private $penilaianService;

    public function __construct(PenilaianService $penilaianService)
    {
        $this->penilaianService = $penilaianService;
    }

    public function index(){
        return view('pages.pengembangan.index', [
            'data' => Kegiatan::with(['asosiasi'])->get()
        ]);
    }

    public function detail($uuid){
        return view('pages.pengembangan.detail', [
            'data' => Kegiatan::with(['asosiasi', 'laporan', 'peserta', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first()
        ]);
    }
    
    public function pengesahan(Request $request, $uuid){
        try {
            $this->penilaianService->penilaianAPI($request, $uuid);
            return redirect(route('pengembangan.index'))->with('success', 'Kegiatan Berhasil disahkan');
        } catch (Throwable $e) {
            return redirect(route('pengembangan.index'))->with('success', $e);
        }
    }
}
