<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Services\Peserta\PesertaService;

class FormAbsenController extends Controller
{
    private $pesertaService;

    public function __construct(PesertaService $pesertaService)
    {
        $this->pesertaService = $pesertaService;
    }

    public function index($uuid)
    {
        return view('pages.kegiatan.form-peserta', [
            'data' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $uuid)->first()
        ]);
    }

    public function store(Request $request){
        $this->pesertaService->store($request);
        return redirect(route('dada'))->with('success', 'Absen Berhasil');
    }

    public function success(){
        return view('success.absen');
    }
}
