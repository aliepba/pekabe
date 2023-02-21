<?php

namespace App\Services\Kegiatan;

use Notification;
use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Jobs\Penilaian;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use App\Models\PenilaianKegiatan;
use App\Models\MtSubUnsurKegiatan;
use App\Models\KegiatanPenyelenggaraLain;
use Illuminate\Http\Request;
use App\Enums\PermohonanStatus;
use App\Models\KegiatanUnverified;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UnsurKegiatanPenyelenggara;
use App\Notifications\KegiatanNotification;

class KegiatanService {
     public function store(Request $request){
        DB::transaction(function () use($request) {
            $kegiatan = Kegiatan::query()->create([
                'uuid' => Uuid::uuid4()->toString(),
                'subklasifikasi' => implode("," ,$request->subklas),
                'penilai' => $request->penilai,
                'jenis_kegiatan' => implode($request->jenis_kegiatan),
                'metode_kegiatan' => implode(",",$request->metode_kegiatan),
                'tingkat_kegiatan' => $request->tingkat_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tempat_kegiatan' => $request->tempat_kegiatan,
                'start_kegiatan' => $request->start_kegiatan,
                'end_kegiatan' => $request->end_kegiatan,
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

            foreach($request->unsur_kegiatan as $unsur){
                UnsurKegiatanPenyelenggara::query()->create([
                    'id_kegiatan' => $kegiatan->uuid,
                    'id_unsur' => $unsur
                ]);
            }


            if(!empty($request->penyelenggara_lain)){
                foreach($request->penyelenggara_lain as $lain){
                    KegiatanPenyelenggaraLain::query()->create([
                        'id_penyelenggara' => $lain,
                        'id_kegiatan' => $kegiatan->uuid
                    ]);
                }
            }


            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::OPEN,
                'keterangan' => 'created',
                'user' => Auth::user()->id
            ]);
        });
     }

     public function update(Request $request, $id){
        $data = Kegiatan::with(['unsurKegiatan'])->find($id);
        DB::transaction(function() use($request, $data){
            $data->update([
                'subklasifikasi' => implode("," ,$request->subklas),
                'penilai' => $request->penilai,
                'jenis_kegiatan' => implode(',',$request->jenis_kegiatan),
                'metode_kegiatan' => implode(",",$request->metode_kegiatan),
                'tingkat_kegiatan' => $request->tingkat_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tempat_kegiatan' => $request->tempat_kegiatan,
                'start_kegiatan' => $request->start_kegiatan,
                'end_kegiatan' => $request->end_kegiatan,
                'tor_kak' => $request->hasFile('tor_kak') ? $request->file('tor_kak')->store('file/tor_kak', 'public') : $data->tor_kak,
                'sk_panitia' => $request->hasFile('sk_panitia') ? $request->file('sk_panitia')->store('file/sk_panitia', 'public') : $data->sk_panitia,
                'cv' => $request->hasFile('cv') ? $request->file('cv')->store('file/cv', 'public') : $data->cv,
                'persyaratan_lain' => $request->hasFile('persyaratan_lain') ? $request->file('persyaratan_lain')->store('file/persyaratan_lain', 'public') : $data->persyaratan_lain,
                'persyaratan_lain_lain' => $request->hasFile('persyaratan_lain_lain') ? $request->file('persyaratan_lain_lain')->store('file/persyaratan_lain_lain', 'public') : $data->persyaratan_lain_lain,
                'status_permohonan_penyelenggara' => $request->id_penyelenggara == null ? PermohonanStatus::SUBMIT : PermohonanStatus::OPEN,
                'id_penyelenggara' => $request->id_penyelenggara,
            ]);

            if(!empty($request->unsur_kegiatan)){
                $data->unsurKegiatan()->forceDelete();
                foreach($request->unsur_kegiatan as $unsur){
                    UnsurKegiatanPenyelenggara::query()->create([
                        'id_kegiatan' => $data->uuid,
                        'id_unsur' => $unsur
                    ]);
                }
            }

            if(!empty($request->penyelenggara_lain)){
                    $data->penyelenggaraLain()->forceDelete();
                    foreach($request->penyelenggara_lain as $lain){
                        KegiatanPenyelenggaraLain::query()->create([
                            'id_penyelenggara' => $lain,
                            'id_kegiatan' => $data->uuid
                        ]);
                    }
            }

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
        $user = User::find($data->user_id);
        DB::transaction(function () use($request, $data, $user){
            $data->update([
                'status_permohonan_kegiatan' => $request->status_permohonan,
                'status_permohonan_penyelenggara' => $request->status_permohonan,
                'tgl_proses' => Carbon::now(),
                'keterangan' => $request->keterangan
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $data->uuid,
                'status_permohonan' => $request->status_permohonan,
                'keterangan' => $request->status_permohonan,
                'user' => Auth::user()->id
            ]);

            Notification::send($user, new KegiatanNotification($data));

        });
     }

     public function unverified(Request $request){
        DB::transaction(function () use($request){
            $kegiatan = KegiatanUnverified::create([
                'uuid' => Uuid::uuid4()->toString(),
                'nama_kegiatan' => $request->nama_kegiatan,
                'jenis_kegiatan' => $request->jenis_kegiatan,
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

            $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($kegiatan->id_unsur_kegiatan);
            $tingkat = 1;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
            $jenis = $unsurKegiatan->bobot->not_verif_penyelenggara != null ? $unsurKegiatan->bobot->not_verif_penyelenggara : $unsurKegiatan->bobot->mandiri;
            $sifat = $unsurKegiatan->bobot->khusus;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $unsurKegiatan->bobot->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $unsurKegiatan->bobot->internasional_dalam_negeri;
            }else{
                $tingkat = $unsurKegiatan->bobot->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'uuid' => $kegiatan->uuid,
                'nilai_skpk' => $unsurKegiatan->nilai_skpk,
                'is_jenis' => $jenis,
                'is_sifat' => $unsurKegiatan->bobot->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)

            ]);

        });
     }
}
