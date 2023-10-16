<?php

namespace App\Services\Kegiatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RollbackService{
    
    public function rollback(Request $request){
        $id = Crypt::decrypt($request->id_hash);
        $kegiatan = Kegiatan::findOrFail($id);

        DB::beginTransaction();

        $kegiatan->status_permohonan_kegiatan = $request->status;
        $kegiatan->save();

        $log = new LogKegiatan();
        $log->id_kegiatan = $kegiatan->uuid;
        $log->status_permohonan = $request->status;
        $log->keterangan = "Rollback Status Kegiatan";
        $log->user = Auth::user()->id;
        $log->save();

        DB::commit();
    }
}