<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;
use App\Actions\Kegiatan\GetValidatorByAPT;
use App\Services\Penilaian\PenilaianService;
use App\Actions\Kegiatan\GetPenilaianValidator;
use App\Actions\Kegiatan\GetDetailPenilaianValidator;

class PenilaianValidatorController extends Controller
{

    private $penilaianService;

    public function __construct(PenilaianService $penilaianService){
        $this->penilaianService = $penilaianService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.verifikasi-validasi.index', GetPenilaianValidator::run());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->PenilaianService->penilaianValidator($request);
        // return redirect(route('verifikasi-validasi.index'))->with('success', 'berhasil dinilai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('pages.verifikasi-validasi.verifikasi', GetDetailPenilaianValidator::run($uuid));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validasi(Request $request, $uuid)
    {
        if($request->status_permohonan_kegiatan == 'PERBAIKAN PELAPORAN'){
            $this->penilaianService->pelaporan($request);
            return redirect(route('verifikasi-validasi.index'))->with('success', 'berhasil dilakukan  dan validasi perbaikan pelaporan');
        }
        
        $this->penilaianService->validasiKegiatan($request, $uuid);
        return redirect(route('verifikasi-validasi.index'))->with('success', 'berhasil diverifikasi dan validasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apt()
    {
        return view('pages.verifikasi-validasi.listByApt', GetValidatorByAPT::run());
    }
}
