<?php

namespace App\Services\Perbaikan;

use Auth;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerbaikanPersyaratan;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PerbaikanNotification;

class PerbaikanService{
    public function addKomen(Request $request){
        $komen = new PerbaikanPersyaratan;
        $komen->id_kegiatan = $request->id_kegiatan;
        $komen->link = $request->link;
        $komen->keterangan = $request->keterangan;
        $komen->user_id = $request->user_id;
        $komen->save();
        $user = User::find($komen->user_id);
        Notification::sendNow($user, new PerbaikanNotification($komen));
        return response()->json($komen);
    }

    public function surat(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'surat_permohonan' => $request->file('surat_permohonan')->store('file/surat_permohonan', 'public')
            ]);
        });
    }

    public function tor(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'tor_kak' => $request->file('tor_kak')->store('file/tor_kak', 'public')
            ]);
        });
    }

    public function cv(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'cv' => $request->file('cv')->store('file/cv', 'public')
            ]);
        });
    }

    public function sk(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'sk_panitia' => $request->file('sk_panitia')->store('file/sk_panitia', 'public')
            ]);
        });
    }

    public function lain1(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'persyaratan_lain' => $request->file('persyaratan_lain')->store('file/persyaratan_lain', 'public')
            ]);
        });
    }

    public function lain2(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'persyaratan_lain_lain' => $request->file('persyaratan_lain_lain')->store('file/persyaratan_lain_lain', 'public')
            ]);
        });
    }
}
