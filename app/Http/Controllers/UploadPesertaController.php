<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use Illuminate\Http\Request;
use App\Models\ExcelPeserta;
use App\Models\Kegiatan;
use App\Models\UploadPeserta;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Peserta\UploadService;

class UploadPesertaController extends Controller
{
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function index($uuid){
        return view('pages.peserta.excel.upload', [
            'data' => Kegiatan::with(['excelPeserta'])->where('uuid', $uuid)->first()
        ]);
    }

    public function import(Request $request, $idKegiatan){
        $this->uploadService->import($request, $idKegiatan);
        return redirect(route('excel', $idKegiatan))->with('success', 'Import Peserta Berhasil harap lakukan edit');
    }

    public function edit($id){
        $data = UploadPeserta::with(['unsur'])->find($id);
        return view('pages.peserta.excel.edit', [
            'data' => $data,
            'kegiatan' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $data->id_kegiatan)->first()
        ]);
    }

    public function update(Request $request, $id, $idKegiatan){
        $idKegiatan = $request->uuid;
        $this->uploadService->update($request, $id);
        return redirect(route('excel', $idKegiatan))->with('success', 'Import Peserta Berhasil harap lakukan edit');
    }
}
