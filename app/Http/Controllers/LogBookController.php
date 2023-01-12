<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('pages.logbook.index');
    }

    public function unverified()
    {
        return view('pages.logbook.unverified');
    }

    public function store(Request $request)
    {
        $this->kegiatanService->unverified($request);
        return redirect(route('kegiatan.unverified'))->with('success', 'yey berhasil!');
    }


}
