<?php

namespace App\Services\Kegiatan;

use Auth;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;

class KegiatanService {
     public function store(Request $request){
        DB::transaction(function () use($request) {
            $kegiatan = Kegiatan::query()->create([
                'uuid' => Uuid::uuid4()->toString(),
                'penyelenggara_lain' => $request->penyelenggara_lain,
                'subklasifikasi' => implode("," ,$request->subklas),
                'penilai' => $request->penilai,
                'unsur_kegiatan' => $request->unsur_kegiatan,
                'metode_kegiatan' => implode(",",$request->metode_kegiatan),
                'tingkat_kegiatan' => $request->tingkat_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tempat_kegiatan' => $request->tempat_kegiatan,
                'start_kegiatan' => $request->start_kegiatan,
                'end_kegiatan' => $request->end_kegiatan,
                'surat_permohonan' => $request->file('surat_permohonan')->store('file/surat_permohonan', 'public'),
                'tor_kak' => $request->file('tor_kak')->store('file/tor_kak', 'public'),
                'sk_panitia' => $request->hasFile('sk_panitia') ? $request->file('sk_panitia')->store('file/sk_panitia', 'public') : null,
                'cv' => $request->hasFile('cv') ? $request->file('cv')->store('file/cv', 'public') : null,
                'persyaratan_lain' => $request->hasFile('persyaratan_lain') ? $request->file('persyaratan_lain')->store('file/persyaratan_lain', 'public') : null,
                'persyaratan_lain_lain' => $request->hasFile('persyaratan_lain_lain') ? $request->file('persyaratan_lain_lain')->store('file/persyaratan_lain_lain', 'public') : null,
                'status_permohonan_kegiatan' => PermohonanStatus::OPEN,
                'status_permohonan_penyelenggara' => $request->id_penyelenggara == null ? PermohonanStatus::SUBMIT : PermohonanStatus::OPEN,
                'id_penyelenggara' => $request->id_penyelenggara,
                'user_id' => Auth::user()->id
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::OPEN,
                'keterangan' => 'created',
                'user' => Auth::user()->id
            ]);
        });
     }

     public function update(Request $request, $uuid){
        $data = Kegiatan::where('uuid', $uuid)->first();
        DB::transaction(function() use($request, $data){
            $data->update([

            ]);
        });
     }

     public function submit($uuid){
        $data = Kegiatan::where('uuid', $uuid)->first();
        DB::transaction(function () use($uuid, $data){
            $data->update([
                'tgl_pengajuan' => Carbon::now(),
                'status_permohonan_kegiatan' => PermohonanStatus::SUBMIT,
                'status_permohonan_penyelenggara' => PermohonanStatus::SUBMIT,
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $uuid,
                'status_permohonan' => PermohonanStatus::SUBMIT,
                'keterangan' => 'submitted',
                'user' => Auth::user()->id
            ]);
        });

     }
}
