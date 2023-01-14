<?php

namespace App\Services\Kegiatan;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use App\Models\KegiatanUnverified;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

     public function update(Request $request, $id){
        $data = Kegiatan::find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
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
                'surat_permohonan' => $request->hasFile('surat_permohonan') ? $request->file('surat_permohonan')->store('file/surat_permohonan', 'public') : $data->surat_permohonan,
                'tor_kak' => $request->hasFile('tor_kak') ? $request->file('tor_kak')->store('file/tor_kak', 'public') : $data->tor_kak,
                'sk_panitia' => $request->hasFile('sk_panitia') ? $request->file('sk_panitia')->store('file/sk_panitia', 'public') : $data->sk_panitia,
                'cv' => $request->hasFile('cv') ? $request->file('cv')->store('file/cv', 'public') : $data->cv,
                'persyaratan_lain' => $request->hasFile('persyaratan_lain') ? $request->file('persyaratan_lain')->store('file/persyaratan_lain', 'public') : $data->persyaratan_lain,
                'persyaratan_lain_lain' => $request->hasFile('persyaratan_lain_lain') ? $request->file('persyaratan_lain_lain')->store('file/persyaratan_lain_lain', 'public') : $data->persyaratan_lain_lain,
                'status_permohonan_kegiatan' => PermohonanStatus::OPEN,
                'status_permohonan_penyelenggara' => $request->id_penyelenggara == null ? PermohonanStatus::SUBMIT : PermohonanStatus::OPEN,
                'id_penyelenggara' => $request->id_penyelenggara,
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

     public function verifikasi(Request $request){
        $data = Kegiatan::find($request->id);
        DB::transaction(function () use($request, $data){
            $data->update([
                'status_permohonan_kegiatan' => $request->status_permohonan,
                'status_permohonan_penyelenggara' => $request->status_permohonan,
                'keterangan' => $request->keterangan
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $data->uuid,
                'status_permohonan' => $request->status_permohonan,
                'keterangan' => $request->status_permohonan,
                'user' => Auth::user()->id
            ]);
        });
     }

     public function unverified(Request $request){
        DB::transaction(function () use($request){
            $kegiatan = KegiatanUnverified::create([
                'uuid' => Uuid::uuid4()->toString(),
                'nama_kegiatan' => $request->nama_kegiatan,
                'id_unsur_kegiatan' => $request->id_unsur_kegiatan,
                'nama_penyelenggara' => $request->nama_penyelenggara,
                'tempat_kegiatan' => $request->tempat_kegiatan,
                'start_kegiatan' => $request->start_kegiatan,
                'end_kegiatan' => $request->end_kegiatan,
                'id_klasifikasi' => $request->id_klasifikasi,
                'metode_kegiatan' => $request->metode,
                'tingkat_kegiatan' => $request->tingkat_kegiatan,
                'upload_persyaratan' => $request->file('upload_persyaratan')->store('file/bukti-kegiatan', 'public'),
                'user_id' => Auth::user()->id
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::SUBMIT,
                'keterangan' => 'created',
                'user' => Auth::user()->id
            ]);

        });
     }
}
