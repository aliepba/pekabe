<?php

namespace App\Services\Pelaporan;

use Carbon\Carbon;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use App\Models\Kegiatan;
use App\Models\PelaporanKegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelaporanService{
    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            PelaporanKegiatan::query()->create([
                'id_kegiatan' => $request->id_kegiatan,
                'upload_persyaratan' => $request->file('upload_persyaratan')->store('file/pelaporan', 'public'),
                'materi_kegiatan' => $request->file('materi_kegiatan')->store('file/pelaporan/materi-kegiatan', 'public'),
                'dokumentasi_kegiatan' => $request->file('dokumentasi_kegiatan')->store('file/pelaporan/materi-dokumentasi_kegiatan', 'public'),
                'user_id' => Auth::user()->id
            ]);
        });
    }

    public function update(Request $request, $id)
    {
        $pelaporanKegiatan = PelaporanKegiatan::find($id);
        DB::transaction(function () use($request, $pelaporanKegiatan){
            $pelaporanKegiatan->update([
                'upload_persyaratan' => $request->file('upload_persyaratan')->store('file/pelaporan', 'public'),
            ]);
        });
    }

    public function submit($id)
    {
        $pelaporanKegiatan = PelaporanKegiatan::find($id);
        DB::transaction(function () use($pelaporanKegiatan){
            $pelaporanKegiatan->update([
                'status_laporan' => PermohonanStatus::SUBMIT
            ]);

            // $peserta = PesertaKegiatan::where('id_kegiatan', $pelaporanKegiatan->id_kegiatan)->get();

            LogKegiatan::query()->create([
                'id_kegiatan' => $pelaporanKegiatan->id_kegiatan,
                'status_permohonan' => PermohonanStatus::SUBMIT,
                'keterangan' => 'laporan sudah disubmit',
                'user' => Auth::user()->id
            ]);
        });
    }
}
