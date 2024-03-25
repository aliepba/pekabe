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
use App\Actions\Kegiatan\GetKegiatanPenyelenggara;
use App\Actions\Kegiatan\GetKegiatanTolak;
use App\Actions\Kegiatan\KegiatanTerverifikasi;
use App\Actions\Kegiatan\KegiatanUnverified;
use App\Models\MtSubUnsurKegiatan;
use App\Models\SettingKegiatan;
use App\Models\SettingPelaporan;
use App\Services\Log\LogService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{

    private $kegiatanService;
    private $logError;

    public function __construct(KegiatanService $kegiatanService, LogService $logError)
    {
        $this->kegiatanService = $kegiatanService;
        $this->logError = $logError;
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
            'setting' => SettingKegiatan::first()          
        ],  GetKegiatanPenyelenggara::run());
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
            'jenis' => MtUnsurKegiatan::whereNotIn('id', [7,8])->get(),
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
        try{
            $this->kegiatanService->store($request);
            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'Kegiatan berhasil dibuat!');
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        }
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
        $kegiatan = Kegiatan::with(['validator', 'timeline', 'peserta', 'laporan',
        'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara' ,
        'jenis', 'nilaiPelaporan', 'nilaiValidasi', 'unsurKegiatan' ,
        'unsurKegiatan.unsur', 'peserta.unsur'])->where('uuid', $uuid)->first();

        if(!$kegiatan){return redirect(route('error.page'));}

        $peserta = DB::SELECT("select a.id, b.nama as skk, c.Nama  as ska, a.nik_peserta, a.unsur_peserta as unsur, a.metode_peserta  from pkb_peserta_kegiatan a
        left join lsp_personal b on a.nik_peserta = b.nik COLLATE utf8mb4_unicode_ci
        left join personal c on a.nik_peserta = c.id_personal
        join pkb_sub_unsur_kegiatan d on a.unsur_peserta = d.id
        where a.id_kegiatan = '$uuid'");


        return view('pages.kegiatan.show', [
            'data' => $kegiatan,
            'peserta' => $peserta,
            'setting' => SettingPelaporan::first(),
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
        $data = Kegiatan::with(['validator', 'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])->find($id);
        if(!$data){return redirect(route('error.page'));}
        $subklas = explode(',', $data->subklasifikasi);
        $metode = explode(',', $data->metode_kegiatan);
        $jenis = explode(',', $data->jenis_kegiatan);

        return view('pages.kegiatan.edit', [
            'data' => $data,
            'subklasifikasi' => $subklas,
            'metode' => $metode,
            'subklas' => MtSubklasifikasi::all(),
            'profesi' => MtAsosiasiProfesi::all(),
            'jenis' => MtUnsurKegiatan::whereNotIn('id', [7,8])->get(),
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
        try{
            $this->kegiatanService->update($request, $id);

            if(Auth::user()->role == 'root' || Auth::user()->role == 'admin'){
                $data = Kegiatan::with(['validator', 'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])->find($id);
                if(!$data){return redirect(route('error.page'));}
                return redirect(route('verifikasi.kegiatan', $data->uuid))->with('success', 'kegiatan berhasil diedit');
            }


            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'kegiatan berhasil diedit!');
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
        try{
            $this->kegiatanService->delete($id);
            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'kegiatan berhasil dihapus!');
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function submit(Request $request, $uuid)
    {
        $this->authorize('submit-kegiatan', Kegiatan::class);
        try{
            $this->kegiatanService->submit($uuid);
            return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'kegiatan berhasil disubmit!');
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function setuju(Request $request)
    {
        try{
            $this->authorize('list-setuju', Kegiatan::class);
            return view('pages.kegiatan.setuju', GetKegiatanByUser::run());
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function tolak(Request $request)
    {
        try{
            $this->authorize('list-tolak', Kegiatan::class);
            return view('pages.kegiatan.tolak', GetKegiatanTolak::run());
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function terverifikasi(Request $request)
    {
        try{
            return view('pages.kegiatan.terverifikasi', KegiatanTerverifikasi::run());
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }

    public function unverified(Request $request)
    {
        try{
            return view('pages.kegiatan.unverified', KegiatanUnverified::run());
        }catch (\Exception $e) {
            $this->logError->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('error', 'Error');
        } 
    }
}
