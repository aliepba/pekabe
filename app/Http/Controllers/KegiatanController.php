<?php

namespace App\Http\Controllers;

use App\Actions\Kegiatan\GetKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\MtUnsurKegiatan;
use App\Models\MtSubklasifikasi;
use App\Models\SubPenyelenggara;
use App\Models\MtAsosiasiProfesi;
use Illuminate\Support\Facades\Auth;
use App\Services\Kegiatan\KegiatanService;
use App\Http\Resources\Kegiatan\KegiatanResource;
use App\Http\Requests\PermohonanKegiatanRequest;
use App\Http\Resources\Kegiatan\KegiatanCollection;
use App\Models\DetailInstansi;
use App\Actions\Kegiatan\GetKegiatanByUser;
use App\Actions\Kegiatan\GetKegiatanTolak;
use App\Models\MtSubUnsurKegiatan;

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
        if(Auth::user()->role == 'sub-user'){
            return view('pages.kegiatan.index', [
                'kegiatan' => new KegiatanCollection(
                    Kegiatan::where('status_permohonan_kegiatan', 'OPEN')->where('user_id', Auth::user()->id)->get()
                ),
            ]);
        }else{
            $data = new KegiatanCollection(Kegiatan::query()->where('user_id', Auth::user()->id)->get());
            return view('pages.kegiatan.index', [
                'kegiatan' => $data
            ]);
        }
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
            'jenis' => MtUnsurKegiatan::all(),
            'unsur' => MtSubUnsurKegiatan::all(),
            'penyelenggara' => DetailInstansi::where('status_permohonan', 'APPROVE')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermohonanKegiatanRequest $request)
    {
        $this->authorize('create-kegiatan', Kegiatan::class);
        $this->kegiatanService->store($request);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'Kegiatan berhasil dibuat!');
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
            'data' => Kegiatan::with(['validator', 'timeline', 'peserta', 'laporan', 'jenis', 'nilaiPelaporan', 'nilaiValidasi', 'unsurKegiatan' ,'unsurKegiatan.unsur', 'peserta.unsur'])->where('uuid', $uuid)->first()
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
        $data = Kegiatan::with(['validator', 'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur'])->find($id);
        $subklas = explode(',', $data->subklasifikasi);
        $metode = explode(',', $data->metode_kegiatan);
        $jenis = explode(',', $data->jenis_kegiatan);

        return view('pages.kegiatan.edit', [
            'data' => $data,
            'subklasifikasi' => $subklas,
            'metode' => $metode,
            'subklas' => MtSubklasifikasi::all(),
            'profesi' => MtAsosiasiProfesi::all(),
            'jenis' => MtUnsurKegiatan::all(),
            'unsur' => MtSubUnsurKegiatan::all(),
            'jenisKegiatan' => $jenis,
            'penyelenggara' => DetailInstansi::where('status_permohonan', 'APPROVE')->get()
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
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'kegiatan berhasil diedit!');
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
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'kegiatan berhasil disubmit!');
    }

    public function setuju()
    {
        $this->authorize('list-setuju', Kegiatan::class);
        return view('pages.kegiatan.setuju', GetKegiatanByUser::run());
    }

    public function tolak()
    {
        $this->authorize('list-tolak', Kegiatan::class);
        return view('pages.kegiatan.setuju', GetKegiatanTolak::run());
    }
}
