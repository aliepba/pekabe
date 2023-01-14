<?php

namespace App\Services\Kegiatan;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\OldKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OldKegiatanService{
    public function store(Request $request){
        DB::transaction(function () use($request){
            OldKegiatan::create([
                'uuid' => Uuid::uuid4()->toString(),
                'id_subklas' => $request->subklas,
                'id_propinsi' => $request->propinsi,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'id_kegiatan' => $request->id_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'sub_kegiatan' => $request->sub_kegiatan,
                'tingkat_kegiatan' => $request->tingkat_kegiatan,
                'id_klas_peran' => $request->id_klas_peran,
                'start_kegiatan' => $request->start_kegiatan,
                'end_kegiatan' => $request->end_kegiatan,
                'jumlah_jam' => $request->jumlah_jam,
                'nilai_skpk' => $request->nilai_skpk,
                'upload_persyaratan' => $request->file('upload_persyaratan')->store('file/bukti-kegiatan', 'public'),
                'user_id' => Auth::user()->id
            ]);
        });
    }
}
