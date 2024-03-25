<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PenilaianPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function list(){
        
        $activity = PenilaianPeserta::where('nik', Auth::user()->nik)->groupBy('id_kegiatan')->get();
        return response()->json([
            'status' => "success",
            'data' => $activity
        ], 200);
    }
}
