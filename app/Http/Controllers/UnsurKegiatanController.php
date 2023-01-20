<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MtUnsurKegiatan;
use App\Services\UnsurKegiatan\UnsurKegiatanService;
use App\Http\Resources\UnsurKegiatan\UnsurKegiatanResource;
use App\Http\Resources\UnsurKegiatan\UnsurKegiatanCollection;


class UnsurKegiatanController extends Controller
{

    private $mtUnsurKegiatan;

    public function __construct(UnsurKegiatanService $mtUnsurKegiatan)
    {
        $this->UnsurKegiatanService = $mtUnsurKegiatan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-unsur');
        return view('pages.unsur-kegiatan.index', [
            'data' => new UnsurKegiatanCollection(
                MtUnsurKegiatan::all()
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('view-unsur');
        return view('pages.unsur-kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-unsur');
        $this->UnsurKegiatanService->store($request);
        return redirect()->route('unsur-kegiatan.index')->with(['success', 'yey berhasil']);
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
        $this->authorize('edit-unsur');
        return view('pages.unsur-kegiatan.edit', [
            'data' => MtUnsurKegiatan::find($id)
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
        $this->authorize('edit-unsur');
        $this->UnsurKegiatanService->update($request, $id);
        return redirect()->route('unsur-kegiatan.index')->with(['success', 'yey berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('view-unsur');
    }
}
