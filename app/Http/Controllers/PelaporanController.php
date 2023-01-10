<?php

namespace App\Http\Controllers;

use App\Models\PelaporanKegiatan;
use Illuminate\Http\Request;
use App\Services\Pelaporan\PelaporanService;

class PelaporanController extends Controller
{

    private $pelaporanService;

    public function __construct(PelaporanService $pelaporanService)
    {
        $this->pelaporanService = $pelaporanService;
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
        $this->pelaporanService->store($request);
        return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'yey berhasil!');
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
        $this->pelaporanService->update($request, $id);
        return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'yey berhasil!');
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
        $this->pelaporanService->submit($id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }
}
