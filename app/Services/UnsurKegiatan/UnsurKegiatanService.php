<?php

namespace App\Services\UnsurKegiatan;

use Illuminate\Http\Request;
use App\Models\MtUnsurKegiatan;
use Illuminate\Support\Facades\DB;

class UnsurKegiatanService{
    public function store(Request $request){
        DB::transaction(function () use($request){
            MtUnsurKegiatan::query()->create([
                'unsur_kegiatan' => $request->unsur_kegiatan
            ]);
        });
    }

    public function update(Request $request, $id){
        $mtUnsurKegiatan = MtUnsurKegiatan::find($id);
        DB::transaction(function () use ($request, $mtUnsurKegiatan){
            $mtUnsurKegiatan->update([
                'unsur_kegiatan' => $request->unsur_kegiatan
            ]);
        });
    }
}
