<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\MtSubklasifikasi;
use App\Models\MtAsosiasiProfesi;
use App\Services\Kegiatan\KegiatanService;
use App\Http\Resources\Kegiatan\KegiatanResource;
use App\Http\Resources\Kegiatan\KegiatanCollection;

class KegiatanController extends Controller
{

    private $kegiatanService;

    public function __construct(KegiatanService $kegiatanService)
    {
        $this->kegiatanService = $kegiatanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kegiatan.index', [
            'kegiatan' => new KegiatanCollection(
                Kegiatan::query()->where('status_permohonan_kegiatan', 'SUBMIT')->paginate(5)
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
        return view('pages.kegiatan.create', [
            'subklas' => MtSubklasifikasi::all(),
            'profesi' => MtAsosiasiProfesi::all()
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
        $this->kegiatanService->store($request);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('pages.kegiatan.show', [
            'data' => Kegiatan::with(['validator', 'timeline'])->where('uuid', $uuid)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
