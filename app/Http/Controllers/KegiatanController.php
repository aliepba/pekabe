<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\MtSubklasifikasi;
use App\Models\MtAsosiasiProfesi;
use Illuminate\Support\Facades\Auth;
use App\Services\Kegiatan\KegiatanService;
use App\Http\Resources\Kegiatan\KegiatanResource;
use App\Http\Resources\Kegiatan\KegiatanCollection;
use App\Models\MtUnsurKegiatan;

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
         $this->authorize('view-kegiatan', Kegiatan::class);
        return view('pages.kegiatan.index', [
            'kegiatan' => new KegiatanCollection(
                Kegiatan::query()->where('user_id', Auth::user()->id)->get()
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
        $this->authorize('create-kegiatan', Kegiatan::class);
        return view('pages.kegiatan.create', [
            'subklas' => MtSubklasifikasi::all(),
            'profesi' => MtAsosiasiProfesi::all(),
            'jenis' => MtUnsurKegiatan::all()
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
        $this->authorize('create-kegiatan', Kegiatan::class);
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
        $this->authorize('submit-kegiatan', Kegiatan::class);
        return view('pages.kegiatan.show', [
            'data' => Kegiatan::with(['validator', 'timeline', 'peserta', 'laporan'])->where('uuid', $uuid)->first()
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
        $this->authorize('edit-kegiatan', Kegiatan::class);
        $data = Kegiatan::with(['validator', 'jenis', 'unsur'])->find($id);
        $subklas = explode(',', $data->subklasifikasi);
        $metode = explode(',', $data->metode_kegiatan);

        return view('pages.kegiatan.edit', [
            'data' => $data,
            'subklasifikasi' => $subklas,
            'metode' => $metode,
            'subklas' => MtSubklasifikasi::all(),
            'profesi' => MtAsosiasiProfesi::all(),
            'jenis' => MtUnsurKegiatan::all()
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
        $this->authorize('update-kegiatan', Kegiatan::class);
        $this->kegiatanService->update($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
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

    public function submit($uuid)
    {
        $this->authorize('submit-kegiatan', Kegiatan::class);
        $this->kegiatanService->submit($uuid);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'yey berhasil!');
    }

    public function setuju()
    {
        $this->authorize('list-setuju', Kegiatan::class);
        return view('pages.kegiatan.setuju', [
            'kegiatan' => new KegiatanCollection(
                Kegiatan::query()->where('status_permohonan_kegiatan', 'APPROVE')->where('user_id', Auth::user()->id)->get()
            )
        ]);
    }

    public function tolak()
    {
        $this->authorize('list-tolak', Kegiatan::class);
        return view('pages.kegiatan.setuju', [
            'kegiatan' => new KegiatanCollection(
                Kegiatan::query()->where('status_permohonan_kegiatan', 'TOLAK')->where('user_id', Auth::user()->id)->get()
            )
        ]);
    }
}
