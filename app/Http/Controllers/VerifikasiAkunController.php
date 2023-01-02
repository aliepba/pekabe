<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailInstansi;
use App\Services\PermohonanAkun\PermohonanAkunService;

class VerifikasiAkunController extends Controller
{
    private $permohonanAkunService;

    public function __construct(PermohonanAkunService $permohonanAkunService)
    {
        $this->permohonanAkunService = $permohonanAkunService;
    }

    public function list(){
        return view('pages.verifikasi.list', [
            'list' => DetailInstansi::with(['penanggungjawab'])->where('status_permohonan', 'SUBMIT')->get()
        ]);
    }

    public function detailPermohonan($uuid){
        return view('pages.verifikasi.detail', [
            'data' => DetailInstansi::with(['penanggungjawab', 'provinsi', 'kabKota'])->where('uuid', $uuid)->first()
        ]);
    }

    public function tolakPermohonan(Request $request, $uuid){
        $this->permohonanAkunService->tolak($request, $uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di tolak');
    }

    public function perbaikanPermohonan(Request $request, $uuid){
        $this->permohonanAkunService->perbaikan($request, $uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di minta perbaikan');
    }

    public function approvePermohonan($uuid){
        $this->permohonanAkunService->approve($uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di approve');
    }

}
