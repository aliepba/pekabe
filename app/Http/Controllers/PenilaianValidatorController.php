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
        $this->PenilaianService = $penilaianService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.penilaian-validator.index', GetPenilaianValidator::run());
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
        $this->PenilaianService->penilaianValidator($request);
        return redirect(route('penilaian-validator.index'))->with('success', 'berhasil dinilai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('pages.penilaian-validator.verifikasi', GetDetailPenilaianValidator::run($uuid));
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
        // $this->penilaianService->validasiKegiatan($request, $uuid);
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        DB::transaction(function () use($request, $kegiatan){
            $kegiatan->update([
                'status_permohonan_kegiatan' => PermohonanStatus::VALIDASI,
                'keterangan_verifikasi' => $request->keterangan_verifikasi
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::VALIDASI,
                'keterangan' => 'kegiatan terverifikasi',
                'user' => 1
            ]);
        });
        return redirect(route('penilaian-validator.index'))->with('success', 'berhasil diverifikasi dan validasi');
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
        return view('pages.penilaian-validator.listByApt', GetValidatorByAPT::run());
    }
}
