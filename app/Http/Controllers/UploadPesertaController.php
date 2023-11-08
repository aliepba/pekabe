<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use Illuminate\Http\Request;
use App\Models\ExcelPeserta;
use App\Models\Kegiatan;
use App\Models\UploadPeserta;
use App\Services\Log\LogService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Peserta\UploadService;

class UploadPesertaController extends Controller
{
    private $uploadService;
    private $logService;

    public function __construct(UploadService $uploadService, LogService $logService)
    {
        $this->uploadService = $uploadService;
        $this->logService = $logService;
    }

    public function index($uuid){
        $data = Kegiatan::with(['excelPeserta'])->where('uuid', $uuid)->first();
        if(!$data){return redirect(route('error.page'));}
        return view('pages.peserta.excel.upload', [
            'data' => $data
        ]);
    }

    public function import(Request $request, $idKegiatan){
        try{
            $this->uploadService->import($request, $idKegiatan);
            return redirect(route('excel', $idKegiatan))->with('success', 'Import Peserta Berhasil harap lakukan edit');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function show($id){
        $data = UploadPeserta::with(['unsur'])->find($id);

        return response()->json([
            'message' => 'Success',
            'data' => $data,
            'kegiatan' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $data->id_kegiatan)->first()
        ]);
    }

    public function edit($id){
        $data = UploadPeserta::with(['unsur'])->find($id);
        if(!$data){return redirect(route('error.page'));}
        return view('pages.peserta.excel.edit', [
            'data' => $data,
            'kegiatan' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $data->id_kegiatan)->first()
        ]);
    }

    public function update(Request $request, $id, $idKegiatan){
        $idKegiatan = $request->uuid;
        try{
            $this->uploadService->update($request, $id);
            return redirect(route('excel', $idKegiatan))->with('success', 'Import Peserta Berhasil harap lakukan edit');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function destroy(Request $request, $id, $idKegiatan){
        $idKegiatan = $request->uuid;
        try{
            $this->uploadService->delete($id);
            return redirect(route('excel', $idKegiatan))->with('success', 'Peserta Berhasil dihapus');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function acc(Request $request, $id, $idKegiatan){
        $idKegiatan = $request->uuid;
        try{
            $this->uploadService->acc($id);
            return redirect(route('excel', $idKegiatan))->with('success', 'Peserta Berhasil diimport');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function updated(Request $request){
        $id = $request->id;
        try{
            $data = $this->uploadService->update($request, $id);
            return response()->json([
                'message' => 'Success update peserta',
                'data' => $data
            ]);
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function data($uuid){
        $data = Kegiatan::with(['excelPeserta'])->where('uuid', $uuid)->first();
        if(!$data){return redirect(route('error.page'));}
        return view('pages.peserta.excel.data', [
            'data' => $data
        ]);
    }
}
