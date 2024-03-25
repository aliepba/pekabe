<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use App\Http\Resources\Kegiatan\KegiatanResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function listKegiatan(){
        try{
            $user = KegiatanResource::collection(
                Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)
                        ->where('start_kegiatan', '>', Carbon::now())
                        ->orderBy('start_kegiatan', 'asc')
                        ->get()
            );
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        } 

        
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
