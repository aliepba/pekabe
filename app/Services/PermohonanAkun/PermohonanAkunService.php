<?php

namespace App\Services\PermohonanAkun;

use Notification;
use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\LogPermohonan;
use App\Models\DetailInstansi;
use App\Models\PenanggungJawab;
use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApproveNotification;
use App\Notifications\PendaftaranNotification;
use App\Notifications\PermohonanAkunNotification;
use App\Notifications\TolakPermohonanNotification;
use App\Notifications\PerbaikanPermohonanNotification;

class PermohonanAkunService
{
    public function store(Request $request){
        DB::transaction(function () use($request){
            $detail = DetailInstansi::query()->create([
                        'uuid' => Uuid::uuid4()->toString(),
                        'jenis' => $request->jenis,
                        'penyelenggara' => $request->jenis_penyelenggara,
                        'nama_instansi' => $request->nama_instansi,
                        'email_instansi' => $request->email_instansi,
                        'alamat' => $request->alamat,
                        'telepon' => $request->telepon,
                        'propinsi' => $request->provinsi,
                        'kab_kota' => $request->kab_kota,
                        'file1' => $request->hasFile('file1') ? $request->file('file1')->store('file/file1', 'public') : null,
                        'file2' => $request->hasFile('file2') ? $request->file('file2')->store('file/file2', 'public') : null,
                        'file3' => $request->hasFile('file3') ? $request->file('file3')->store('file/file3', 'public') : null,
            ]);

            $data = PenanggungJawab::query()->create([
                'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
                'nik' => $request->nik,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'password' => $request->password,
                'upload_persyaratan' => $request->hasFile('upload_persyaratan') ? $request->file('upload_persyaratan')->store('file/sk_penunjukan', 'public') : null,
                'id_detail_instansi' => $detail->uuid
            ]);

            Notification::send($data, new PendaftaranNotification($detail));
        });
    }

    public function update(Request $request, $uuid){
        $detail = DetailInstansi::where('uuid', $uuid)->first();
        $penanggungjawab = PenanggungJawab::where('id_detail_instansi', $uuid)->first();

        DB::transaction(function () use ($request, $detail, $penanggungjawab){
            $detail->update([
                'jenis' => $request->jenis,
                'penyelenggara' => $request->jenis_penyelenggara,
                'nama_instansi' => $request->nama_instansi,
                'email_instansi' => $request->email_instansi,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'propinsi' => $request->provinsi,
                'kab_kota' => $request->kab_kota,
                'file1' => $request->hasFile('file1') ? $request->file('file1')->store('file/file1', 'public') : $detail->file1,
                'file2' => $request->hasFile('file2') ? $request->file('file2')->store('file/file2', 'public') : $detail->file2,
                'file3' => $request->hasFile('file3') ? $request->file('file3')->store('file/file3', 'public') : $detail->file3,
                'status_permohonan' => PermohonanStatus::SUBMIT,
            ]);

            $penanggungjawab->update([
                'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
                'nik' => $request->nik,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'password' => $request->password,
                'upload_persyaratan' => $request->hasFile('upload_persyaratan') ? $request->file('upload_persyaratan')->store('file/sk_penunjukan', 'public') : $detail->upload_persyaratan,
            ]);
        });
    }

    public function tolak(Request $request, $uuid){
        DB::transaction(function () use($request, $uuid){
            $permohonan = DetailInstansi::with(['penanggungjawab'])->where('uuid', $uuid)->first();
            $permohonan->update([
                'status_permohonan' => PermohonanStatus::TOLAK,
                'tgl_proses' => Carbon::now()
            ]);

            $log = LogPermohonan::query()->create([
                'id_detail_instansi' => $permohonan->uuid,
                'status_permohonan' => PermohonanStatus::TOLAK,
                'keterangan' => $request->keterangan,
                'user' => Auth::user()->id
            ]);

            Notification::route('mail', $permohonan->penanggungjawab->email)->notify(new TolakPermohonanNotification($log));
        });
    }

    public function perbaikan(Request $request, $uuid){
        DB::transaction(function () use($request, $uuid){
            $permohonan = DetailInstansi::with(['penanggungjawab'])->where('uuid', $uuid)->first();
            $permohonan->update([
                'status_permohonan' => PermohonanStatus::PERBAIKAN,
            ]);

            $log = LogPermohonan::query()->create([
                'id_detail_instansi' => $permohonan->uuid,
                'status_permohonan' => PermohonanStatus::PERBAIKAN,
                'keterangan' => $request->keterangan,
                'user' => Auth::user()->id
            ]);

            Notification::route('mail', $permohonan->penanggungjawab->email)->notify(new PerbaikanPermohonanNotification($log));
        });
    }

    public function approve($uuid){
        DB::transaction(function () use($uuid){
            $permohonan = DetailInstansi::with(['penanggungjawab'])->where('uuid', $uuid)->first();
            $permohonan->update([
                'status_permohonan' => PermohonanStatus::APPROVE,
                'tgl_proses' => Carbon::now()
            ]);

            LogPermohonan::query()->create([
                'id_detail_instansi' => $permohonan->uuid,
                'status_permohonan' => PermohonanStatus::APPROVE,
                'keterangan' => 'akun approved',
                'user' => Auth::user()->id
            ]);

            $user = User::query()->create([
                'name' => $permohonan->nama_instansi,
                'email' => $permohonan->email_instansi,
                'email_verified_at' => Carbon::now(),
                'role' => 'user',
                'password' => Hash::make($permohonan->penanggungjawab->password),
                'jenis_penyelenggara' => $permohonan->jenis
            ]);

            $user->syncRoles('user');

            Notification::route('mail', $permohonan->penanggungjawab->email)->notify(new ApproveNotification($permohonan));
        });
    }
}
