<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Services\Kegiatan\RollbackService;
use App\Services\Log\LogService;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;

class RollbackController extends Controller
{

    private $rollbackService;
    private $logService;

    public function __construct(RollbackService $rollbackService, LogService $logService)
    {
        $this->rollbackService = $rollbackService;
        $this->logService = $logService;
    }
 

    public function index()
    {
        $kegiatan = Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->get();
        $status = self::optStatus();
        return view('pages.kegiatan.rollback.index', compact('kegiatan', 'status'));
    }

    public function process(Request $request)
    {
        try{
            $this->rollbackService->rollback($request);
            return redirect(route('rollback'))->with('success', 'Rollback Success');
        }catch (\Exception $e) {
            DB::rollback();
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function optStatus()
    {
        return [
            [
                'value' => PermohonanStatus::SUBMIT,
                'desc' => "Batal Setujui"
            ],
        ];
    }
}
