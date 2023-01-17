<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailInstansi;
use App\Models\MtPenyelenggara;
use App\Actions\Asosiasi\AsosiasiList;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PermohonanAkunRequest;
use App\Services\PermohonanAkun\PermohonanAkunService;

class PermohonanAkunController extends Controller
{
    private $permohonanAkunService;

    public function __construct(PermohonanAkunService $permohonanAkunService)
    {
        $this->permohonanAkunService = $permohonanAkunService;
    }

    public function index(){
        return view('auth.permohonan-akun', [
            'jenis' => MtPenyelenggara::all()
        ]);
    }

    public function form(Request $request){
        $jenis = $request->jenis_penyelenggara;

        if($jenis == 1){
            return view('pages.form-jenis-penyelenggara.pemerintah', [
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($jenis == 2){
            return view('pages.form-jenis-penyelenggara.asosiasi-profesi', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ], AsosiasiList::run());
        }

        if($jenis == 3){
            return view('pages.form-jenis-penyelenggara.asosiasi-badan-usaha', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ], AsosiasiList::run());
        }

        if($jenis == 4){
            return view('pages.form-jenis-penyelenggara.asosiasi-rantai-pasok', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ]);
        }

        if($jenis == 5){
            return view('pages.form-jenis-penyelenggara.lppk', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ]);
        }

        if($jenis == 6){
            return view('pages.form-jenis-penyelenggara.konsultan-kontraktor', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ]);
        }

        if($jenis == 7){
            return view('pages.form-jenis-penyelenggara.perakit-distributor', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ]);
        }

        if($jenis == 8){
            return view('pages.form-jenis-penyelenggara.other', [
                'propinsi' => DB::table('propinsi_dagri')->get(),
            ]);
        }
    }


    public function store(PermohonanAkunRequest $request){
        $this->permohonanAkunService->store($request);
        return redirect()->route('permohonan.akun')->with('success', 'Permohonan Berhasil di Ajukan');
    }

    public function edit($uuid){
        $data = DetailInstansi::where('uuid', $uuid)->first();

        if($data->status_permohonan == 'SUBMIT' || $data->status_permohonan == 'TOLAK' || $data->status_permohonan == 'APPROVED'){
            return view('errors.419');
        }

        if($data->jenis == 1){
            return view('pages.form-jenis-penyelenggara.edit.edit-pemerintah', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($data->jenis == 2){
            return view('pages.form-jenis-penyelenggara.edit.edit-asosiasi-profesi', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota', 'asosiasiProfesi'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get(),
                'asosiasi' => DB::table('personal_profesi_ta_detail')->get(),
            ]);
        }

        if($data->jenis == 3){
            return view('pages.form-jenis-penyelenggara.edit.edit-asosiasi-badan-usaha', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota', 'asosiasiBadanUsaha'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get(),
                'asosiasi' => DB::table('bu_asosiasi_detail')->get(),
            ]);
        }

        if($data->jenis == 4){
            return view('pages.form-jenis-penyelenggara.edit.edit-asosiasi-rantai-pasok', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($data->jenis == 5){
            return view('pages.form-jenis-penyelenggara.edit.edit-lppk', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($data->jenis == 6){
            return view('pages.form-jenis-penyelenggara.edit.edit-konsultan-kontraktor', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($data->jenis == 7){
            return view('pages.form-jenis-penyelenggara.edit.edit-perakit-distributor', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }

        if($data->jenis == 8){
            return view('pages.form-jenis-penyelenggara.edit.edit-other', [
                'data' => DetailInstansi::with(['provinsi', 'kabKota'])->where('uuid', $uuid)->first(),
                'propinsi' => DB::table('propinsi_dagri')->get()
            ]);
        }



    }
}
