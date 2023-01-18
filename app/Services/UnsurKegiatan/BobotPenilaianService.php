<?php

namespace App\Services\UnsurKegiatan;

use Illuminate\Http\Request;
use App\Models\MtBobotPenilaian;
use Illuminate\Support\Facades\DB;

class BobotPenilaianService{
    public function store(Request $request){
        DB::transaction(function ()  use($request){
            MtBobotPenilaian::query()->create([
            'nama_unsur' => $request->nama_unsur,
            'verif' => $request->verif,
            'not_verif_penyelenggara' => $request->not_verif_penyelenggara,
            'not_verif_not_penyelenggara' => $request->not_verif_not_penyelenggara,
            'mandiri' => $request->mandiri,
            'umum' => $request->umum,
            'khusus' => $request->khusus,
            'tatap_muka' => $request->tatap_muka,
            'daring' => $request->daring,
            'nasional' => $request->nasional,
            'internasional_dalam_negeri' => $request->internasional_dalam_negeri,
            'internasional_luar_negeri' => $request->internasional_luar_negeri
           ]);
        });
    }

    public function update(Request $request, $id){
        $data = MtBobotPenilaian::find($id);
        DB::transaction(function () use($request, $data){
            $data->update([
                'nama_unsur' => $request->nama_unsur,
                'verif' => $request->verif,
                'not_verif_penyelenggara' => $request->not_verif_penyelenggara,
                'not_verif_not_penyelenggara' => $request->not_verif_not_penyelenggara,
                'mandiri' => $request->mandiri,
                'umum' => $request->umum,
                'khusus' => $request->khusus,
                'tatap_muka' => $request->tatap_muka,
                'daring' => $request->daring,
                'nasional' => $request->nasional,
                'internasional_dalam_negeri' => $request->internasional_dalam_negeri,
                'internasional_luar_negeri' => $request->internasional_luar_negeri
            ]);
        });
    }
}
