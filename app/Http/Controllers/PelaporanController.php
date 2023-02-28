<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PelaporanKegiatan;
use Illuminate\Http\Request;
use App\Services\Pelaporan\PelaporanService;
use App\Jobs\isVerifikasi;
use App\Jobs\Penilaian;
use App\Services\Penilaian\PenilaianService;

class PelaporanController extends Controller
{

    private $pelaporanService;
    private $penilaianService;

    public function __construct(PelaporanService $pelaporanService, PenilaianService $penilaianService)
    {
        $this->pelaporanService = $pelaporanService;
        $this->penilaianService = $penilaianService;
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
        // $this->authorize('pelaporan', PelaporanKegiatan::class);
        $this->pelaporanService->store($request);
        return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'pengunggahan data laporan kegiatan PKB telah berhasil!');
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
        $this->pelaporanService->update($request, $id);
        return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'pengunggahan data laporan kegiatan PKB telah berhasil diupdate!');
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

    public function submit($id)
    {
        // $this->authorize('submit_pelaporan', PelaporanKegiatan::class);
        $this->pelaporanService->submit($id);
        $this->penilaianService->penilaianPeserta($id);
        dispatch(new Penilaian($id));
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'data laporan kegiatan berhasil disubmit!');
    }
}
