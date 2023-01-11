<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\PerbaikanPersyaratan;
use App\SErvices\Perbaikan\PerbaikanService;

class VerifikasiKegiatanController extends Controller
{

    private $perbaikanService;

    public function __construct(PerbaikanService $perbaikanService)
    {
        $this->perbaikanService = $perbaikanService;
    }

    public function list()
    {
        return view('pages.verifikasi-kegiatan.list', [
            'data' => Kegiatan::with(['validator'])->where('penilai', 000)->get()
        ]);
    }

    public function detail($uuid)
    {
        return view('pages.verifikasi-kegiatan.detail', [
            'data' => Kegiatan::with(['validator'])->where('uuid', $uuid)->first()
        ]);
    }

    public function addKomen(Request $request)
    {
        $this->perbaikanService->addKomen($request);
    }
}
