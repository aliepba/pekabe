<?php

namespace App\Services\UnsurKegiatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MtSubUnsurKegiatan;

class SubUnsurKegiatan{
    public function store(Request $request){
        DB::transaction(function () use($request){
            MtSubUnsurKegiatan::query()->create([
                'id_unsur_kegiatan' => $request->id_unsur_kegiatan,
                'id_bobot_penilaian' => $request->id_bobot_penilaian,
                'nama_sub_unsur' => $request->nama_sub_unsur,
                'nilai_skpk' => $request->nilai_skpk
            ]);
        });
    }

    public function update(Request $request, $id){
        $data = MtSubUnsurKegiatan::find($id);
        DB::transaction(function () use($request, $data){
            $data->update([
                'id_unsur_kegiatan' => $request->id_unsur_kegiatan,
                'id_bobot_penilaian' => $request->id_bobot_penilaian,
                'nama_sub_unsur' => $request->nama_sub_unsur,
                'nilai_skpk' => $request->nilai_skpk
            ]);
        });
    }
}
