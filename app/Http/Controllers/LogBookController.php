<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\LogBook;
use Illuminate\Http\Request;
use App\Models\MtKlasifikasi;
use App\Models\MtUnsurKegiatan;
use App\Models\KegiatanUnverified;
use App\Actions\Logbook\TenagaAhli;
use Illuminate\Support\Facades\Auth;
use App\Actions\Logbook\GetRekapSKPK;
use App\Actions\Logbook\GetLogKegiatan;
use App\Actions\Logbook\GetRekapExport;
use App\Services\Kegiatan\KegiatanService;
use App\Actions\Logbook\KegiatanTenagaAhli;
use App\Services\Log\LogService;
use Illuminate\Support\Facades\DB;

class LogBookController extends Controller
{

    private $kegiatanService;
    private $logService;

    public function __construct(KegiatanService $kegiatanService, LogService $logService)
    {
        $this->kegiatanService = $kegiatanService;
        $this->logService = $logService;
    }

    public function index()
    {
        $this->authorize('list-kegiatan');
        return view('pages.logbook.index',
                    KegiatanTenagaAhli::run(),
                    TenagaAhli::run(Auth::user()->nik)
                );
    }

    public function unverified()
    {
        $this->authorize('kegiatan-unverified');
        return view('pages.logbook.unverified', [
            'jenis' => MtUnsurKegiatan::all(),
            'klas' => MtKlasifikasi::all()
        ]);
    }

    public function edit($id){
        return view('pages.logbook.edit', [
            'data' => KegiatanUnverified::with(['jenis', 'unsur'])->find($id),
            'jenis' => MtUnsurKegiatan::all(),
            'klas' => MtKlasifikasi::all()
        ]);
    }

    public function update(Request $request, $id){
        try{
            $this->kegiatanService->updateKegiatanUnverified($request, $id);
            return redirect(route('logbook.index'))->with('success', 'berhasil diupdate');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function delete(Request $request, $id){
        try{
            $this->kegiatanService->deleteKegiatanUnverified($id);
            return redirect(route('logbook.index'))->with('success', 'berhasil dihapus');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function store(Request $request)
    {
        try{
            $this->kegiatanService->unverified($request);
            return redirect(route('kegiatan.unverified'))->with('success', 'berhasil disimpan!');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function listSkpk(){
        return view('pages.logbook.kegiatan', GetLogKegiatan::run(), GetRekapSKPK::run());
    }

    public function export($subBidang){
        $pdf = PDF::loadview('pdf.summary', GetRekapExport::run($subBidang));
        return $pdf->stream();
    }


}
