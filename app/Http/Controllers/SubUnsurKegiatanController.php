<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MtUnsurKegiatan;
use App\Models\MtBobotPenilaian;
use App\Models\MtSubUnsurKegiatan;
use App\Services\UnsurKegiatan\SubUnsurKegiatan;

class SubUnsurKegiatanController extends Controller
{

    private $subUnsurService;

    public function __construct(SubUnsurKegiatan $subUnsurService)
    {
        $this->subUnsurService = $subUnsurService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sub-unsur-kegiatan.index', [
            'data' => MtSubUnsurKegiatan::with(['jenisKegiatan'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sub-unsur-kegiatan.create',[
            'unsur' => MtUnsurKegiatan::all(),
            'bobot' => MtBobotPenilaian::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->subUnsurService->store($request);
        return redirect()->route('sub-unsur-kegiatan.index')->with(['success', 'yey berhasil']);
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
        return view('pages.sub-unsur-kegiatan.edit', [
            'item' => MtSubUnsurKegiatan::findOrFail($id),
            'unsur' => MtUnsurKegiatan::all(),
            'bobot' => MtBobotPenilaian::all()
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
        $this->subUnsurService->update($request, $id);
        return redirect()->route('sub-unsur-kegiatan.index')->with(['success', 'yey berhasil']);
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
}
