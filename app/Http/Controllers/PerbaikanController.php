<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Services\Perbaikan\PerbaikanService;

class PerbaikanController extends Controller
{
    private $perbaikaService;

    public function __construct(PerbaikanService $perbaikanService)
    {
        $this->perbaikaService = $perbaikanService;
    }

    public function surat($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.surat-permohonan', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function tor($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.tor', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function cv($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.cv', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function sk($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.sk', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function lain1($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.lain1', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function lain2($uuid){
        return view('pages.verifikasi-kegiatan.perbaikan.lain2', [
            'data' => Kegiatan::where('uuid', $uuid)->first()
        ]);
    }

    public function updateSurat(Request $request, $id){
        $this->perbaikaService->surat($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function updateTor(Request $request, $id){
        $this->perbaikaService->tor($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function updateCV(Request $request, $id){
        $this->perbaikaService->cv($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function updateSK(Request $request, $id){
        $this->perbaikaService->sk($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function updateLain1(Request $request, $id){
        $this->perbaikaService->lain1($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function updateLain2(Request $request, $id){
        $this->perbaikaService->lain2($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }
}
