<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PelaporanKegiatan;
use Illuminate\Http\Request;
use App\Services\Pelaporan\PelaporanService;
use App\Jobs\isVerifikasi;
use App\Jobs\Penilaian;
use App\Services\Log\LogService;
use App\Services\Penilaian\PenilaianService;
use Illuminate\Support\Facades\DB;

class PelaporanController extends Controller
{

    private $pelaporanService;
    private $penilaianService;
    private $logService;

    public function __construct(
        PelaporanService $pelaporanService, 
        PenilaianService $penilaianService,
        LogService $logService)
    {
        $this->pelaporanService = $pelaporanService;
        $this->penilaianService = $penilaianService;
        $this->logService = $logService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('pelaporan', PelaporanKegiatan::class);\
        try{
            $this->pelaporanService->store($request);
            return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'pengunggahan data laporan kegiatan PKB telah berhasil!');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.kegiatan.pelaporan.edit', [
            'item' => PelaporanKegiatan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->authorize('pelaporan', PelaporanKegiatan::class);
        try{
            $this->pelaporanService->update($request, $id);
            return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'pengunggahan data laporan kegiatan PKB telah berhasil diupdate!');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
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

    public function submit(Request $request,  $id)
    {
        // $this->authorize('submit_pelaporan', PelaporanKegiatan::class);
        // $this->penilaianService->penilaianPeserta($id);
        // dispatch(new Penilaian($id));
        try{
            $this->pelaporanService->submit($id);
            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'data laporan kegiatan berhasil disubmit!');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function submitUnverified(Request $request, $id)
    {
        try{
            $this->pelaporanService->submitUnverified($id);
            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'data laporan kegiatan berhasil disubmit sebagai kegiatan unverified!');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }
}
