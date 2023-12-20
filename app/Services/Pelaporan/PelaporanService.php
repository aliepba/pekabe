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
                'undangan_kegiatan' => $request->file('undangan_kegiatan')->store('file/pelaporan/undangan-kegiatan', 'public'),
                'daftar_hadir' => $request->file('daftar_hadir')->store('file/pelaporan/daftar-hadir', 'public'),
                'link_pelaporan' => $request->link_pelaporan != null ? $request->link_pelaporan : null,
                'user_id' => Auth::user()->id
            ]);
        });
    }

    public function update(Request $request, $id)
    {
        $pelaporanKegiatan = PelaporanKegiatan::find($id);
        DB::transaction(function () use($request, $pelaporanKegiatan){
            $pelaporanKegiatan->update([
                'upload_persyaratan' => $request->hasFile('upload_persyaratan') ? $request->file('upload_persyaratan')->store('file/pelaporan', 'public') : $pelaporanKegiatan->upload_persyaratan,
                'materi_kegiatan' => $request->hasFile('materi_kegiatan') ?  $request->file('materi_kegiatan')->store('file/pelaporan/materi-kegiatan', 'public') :  $pelaporanKegiatan->materi_kegiatan,
                'dokumentasi_kegiatan' => $request->hasFile('dokumentasi_kegiatan') ? $request->file('dokumentasi_kegiatan')->store('file/pelaporan/materi-dokumentasi_kegiatan', 'public') : $pelaporanKegiatan->dokumentasi_kegiatan,
                'undangan_kegiatan' => $request->hasFile('undangan_kegiatan') ? $request->file('undangan_kegiatan')->store('file/pelaporan/undangan-kegiatan', 'public') : $pelaporanKegiatan->undangan_kegiatan,
                'daftar_hadir' => $request->hasFile('daftar_hadir') ? $request->file('daftar_hadir')->store('file/pelaporan/daftar-hadir', 'public') : $pelaporanKegiatan->daftar_hadir,
                'link_pelaporan' => $request->link_pelaporan != null ? $request->link_pelaporan : $pelaporanKegiatan->link_pelaporan,
            ]);
        });
    }

    public function submit($id)
    {
        $pelaporanKegiatan = PelaporanKegiatan::find($id);
        $kegiatan = Kegiatan::where('uuid', $pelaporanKegiatan->id_kegiatan)->first();
        DB::transaction(function () use($pelaporanKegiatan, $kegiatan){
            $pelaporanKegiatan->update([
                'status_laporan' => PermohonanStatus::SUBMIT
            ]);

            $kegiatan->update([
                'status_permohonan_kegiatan' => PermohonanStatus::PELAPORAN
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $pelaporanKegiatan->id_kegiatan,
                'status_permohonan' => PermohonanStatus::PELAPORAN,
                'keterangan' => 'laporan sudah disubmit',
                'user' => Auth::user()->id
            ]);
        });
    }
}
