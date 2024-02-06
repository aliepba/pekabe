<?php

namespace App\Http\Controllers;

use App\Enums\SiJKT;
use App\Services\Log\LogService;
use Illuminate\Http\Request;
use App\Services\Login\SIJKTService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class SiJKTController extends Controller
{
    private $sijktService;
    private $logService;

    public function __construct(SIJKTService $sijktService, LogService $logService)
    {
        $this->sijktService = $sijktService;
        $this->logService = $logService;
    }

    public function login($id, $token){
        return view('auth.login-sijkt', [
            'id' => $id,
            'token' => $token
        ]);
    }

    public function sijkt(){
        $encodedToken = base64_encode(SiJKT::NUMBER() . ':' . SiJKT::KEY());

        return redirect(SiJKT::URL() . '/connect/' . $encodedToken);
    }

    public function proses(Request $request){
        return $this->sijktService->index($request);
    }

    public function connect(Request $request){
        try{
            $this->sijktService->connect($request);
            return redirect(route('dashboard.tenaga.ahli'))->with('success', 'Login Berhasil');
        }catch(\Exception $e){
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('sijkt'))->with('success', 'Harap Login SIJKT Terlebih dahulu');
        }
    }

}
