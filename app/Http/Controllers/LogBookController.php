<?php

namespace App\Http\Controllers;

use App\Actions\Logbook\GetRekapSKPK;
use App\Actions\Logbook\KegiatanTenagaAhli;
use App\Models\LogBook;
use Illuminate\Http\Request;
use App\Models\MtKlasifikasi;
use App\Models\MtUnsurKegiatan;
use App\Actions\Logbook\TenagaAhli;
use App\Actions\Logbook\GetLogKegiatan;
use Illuminate\Support\Facades\Auth;
use App\Services\Kegiatan\KegiatanService;

class LogBookController extends Controller
{

    private $kegiatanService;

    public function __construct(KegiatanService $kegiatanService)
    {
        $this->kegiatanService = $kegiatanService;
    }

    public function index()
    {
        $this->authorize('list-kegiatan');
        return view('pages.logbook.index',
                    KegiatanTenagaAhli::run(Auth::user()->nik, Auth::user()->id),
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

    public function store(Request $request)
    {
        $this->kegiatanService->unverified($request);
        return redirect(route('kegiatan.unverified'))->with('success', 'berhasil disimpan!');
    }

    public function listSkpk(){
        return view('pages.logbook.kegiatan', GetLogKegiatan::run(), GetRekapSKPK::run());
    }


}
