<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Services\Log\LogService;
use Illuminate\Http\Request;
use App\Services\Peserta\PesertaService;
use Carbon\Carbon;

class FormAbsenController extends Controller
{
    private $pesertaService;
    private $logService;

    public function __construct(PesertaService $pesertaService, LogService $logService)
    {
        $this->pesertaService = $pesertaService;
        $this->logService = $logService;
    }

    public function index($uuid)
    {

        $data = Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $uuid)->first();
        if(!$data){return redirect(route('error.page'));}

        if($data->end_kegiatan > Carbon::now()){
            return view('Form Absen Kegiatan Sudah Expired');
        }
        
        return view('pages.kegiatan.form-peserta', [
            'data' => $data
        ]);
    }

    public function store(Request $request){
        try{
            $this->pesertaService->store($request);
            return redirect(route('absen.success'))->with('success', 'Absen Berhasil');
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('absen.peserta'))->with('error', 'Absen Gagal');
        } 
    }

    public function success(){
        return view('success.absen');
    }
}
