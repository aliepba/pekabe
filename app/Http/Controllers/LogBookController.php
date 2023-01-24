<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use Illuminate\Http\Request;
use App\Models\MtKlasifikasi;
use App\Actions\Logbook\TenagaAhli;
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
        return view('pages.logbook.index', TenagaAhli::run(Auth::user()->nik));
    }

    public function unverified()
    {
        $this->authorize('kegiatan-unverified');
        return view('pages.logbook.unverified', [
            'klas' => MtKlasifikasi::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->kegiatanService->unverified($request);
        return redirect(route('kegiatan.unverified'))->with('success', 'yey berhasil!');
    }


}
