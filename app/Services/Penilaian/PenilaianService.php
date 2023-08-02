<?php

namespace App\Services\Penilaian;

use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Jobs\Penilaian;
use App\Models\Kegiatan;
use App\Models\LogKegiatan;
use Illuminate\Http\Request;
use App\Models\PesertaKegiatan;
use App\Enums\PermohonanStatus;
use App\Models\PenilaianPeserta;
use App\Models\MtBobotPenilaian;
use App\Models\PenilaianKegiatan;
use App\Models\PelaporanKegiatan;
use App\Models\PenilaianValidator;
use Illuminate\Support\Facades\DB;
use App\Models\MtSubUnsurKegiatan;
use App\Actions\Logbook\TenagaAhli;
use App\Actions\Referensi\GetSKA;
use App\Actions\Referensi\GetSKK;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PengesahanNotification;
use App\Notifications\PerbaikanPelaporanNotification;
use App\Models\Pengembangan\Kegiatan as KegiatanAPI;
use App\Models\Pengembangan\PenilaianAPI;
use App\Models\Pengembangan\PesertaAPI;
use App\Notifications\TerverifikasiNotification;
use App\Notifications\ValidasiNotification;

class PenilaianService{

    public function verifikasi($uuid){
        $kegiatan = Kegiatan::with(['peserta'])->where('uuid', $uuid)->first();
        $bobotPenilaian = MtBobotPenilaian::find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $bobotPenilaian){
            $kegiatan->update([
                'is_verifikasi' => 1
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $bobotPenilaian->tatap_muka : $bobotPenilaian->daring;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $bobotPenilaian->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $bobotPenilaian->internasional_dalam_negeri;
            }else{
                $tingkat = $bobotPenilaian->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'is_jenis' => 1,
                'is_sifat' => $bobotPenilaian->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => 1 * 1 * $metode * $tingkat
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::TERVERIFIKASI,
                'keterangan' => 'kegiatan terverifikasi',
                'user' => Auth::user()->id
            ]);


        });
    }

    public function unverified($uuid){
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        $bobotPenilaian = MtBobotPenilaian::find($kegiatan->unsur_kegiatan);
        DB::transaction(function () use($kegiatan, $bobotPenilaian){
            $kegiatan->update([
                'is_verifikasi' => 0
            ]);

            $tingkat = 0;
            $metode = $kegiatan->metode_kegiatan == 'Tatap Muka' ? $bobotPenilaian->tatap_muka : $bobotPenilaian->daring;

            if($kegiatan->tingkat_kegiatan == 1){
                $tingkat = $bobotPenilaian->nasional;
            }elseif($kegiatan->tingkat_kegiatan == 2){
                $tingkat = $bobotPenilaian->internasional_dalam_negeri;
            }else{
                $tingkat = $bobotPenilaian->internasional_luar_negeri;
            }

            PenilaianKegiatan::query()->create([
                'is_jenis' => $bobotPenilaian->not_verif_penyelenggara,
                'is_sifat' => $bobotPenilaian->khusus,
                'is_metode' => $metode,
                'is_tingkat' => $tingkat,
                'angka_kredit' => 1 * $bobotPenilaian->not_verif_penyelenggara * $metode * $tingkat
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::UNVERIFIED,
                'keterangan' => 'kegiatan tidak terverifikasi',
                'user' => Auth::user()->id
            ]);
        });
    }

    public function penilaianValidator(Request $request){
        $kegiatan = Kegiatan::where('uuid', $request->id_kegiatan)->first();
        DB::transaction(function () use($request, $kegiatan){
            $kegiatan->update([
                'tgl_penilaian' => Carbon::now(),
                'status_permohonan_kegiatan' => PermohonanStatus::PENILAIAN
            ]);

            $idUnsur = $request->input('id_unsur');
            $nilai = $request->input('nilai_skpk');
            $jenis = $request->input('is_jenis');
            $sifat = $request->input('is_sifat');
            $metode = $request->input('is_metode');
            $tingkat = $request->input('is_tingkat');

            for($i=0; $i < count($nilai); $i++){
                PenilaianValidator::query()->create([
                    'id_kegiatan' => $kegiatan->uuid,
                    'id_unsur' => $idUnsur[$i],
                    'nilai_skpk' => $nilai[$i],
                    'is_jenis' => $jenis[$i],
                    'is_sifat' => $sifat[$i],
                    'is_metode' => $metode[$i],
                    'is_tingkat' => $tingkat[$i],
                    'angka_kredit' => (float)$nilai[$i] * ($jenis[$i] == null ? 1 : (float)$jenis[$i]) * ($sifat[$i] == null ? 1 : (float)$sifat[$i]) * ($metode[$i] == null ? 1 : (float)$metode[$i]) * ($tingkat[$i] == null ? 1 : (float)$tingkat[$i]),
                    'validate_by' => Auth::user()->id
                ]);
            }

            LogKegiatan::query()->create([
                 'id_kegiatan' => $request->id_kegiatan,
                'status_permohonan' => PermohonanStatus::PENILAIAN,
                'keterangan' => 'kegiatan sudah dilakukan penilaian oleh validator',
                'user' => Auth::user()->id
            ]);
        });
    }

    public function penilaianPeserta($uuid){
        $kegiatan = Kegiatan::with(['peserta'])->where('uuid', $uuid)->first();
        DB::transaction(function () use($kegiatan){
            foreach($kegiatan->peserta as $item){
                $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($item->unsur_peserta);

                $tingkat = 1;
                $jenis = 1;
                $metode = $item->metode_peserta == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
                $sifat = $unsurKegiatan->bobot->khusus;

                if($kegiatan->tingkat_kegiatan === "1"){
                    $tingkat = $unsurKegiatan->bobot->nasional;
                }elseif($kegiatan->tingkat_kegiatan === "2"){
                    $tingkat = $unsurKegiatan->bobot->internasional_dalam_negeri;
                }else{
                    $tingkat = $unsurKegiatan->bobot->internasional_luar_negeri;
                }

                $subklas = explode(',', $kegiatan->subklasifikasi);

                foreach(GetSKK::run($item->nik_peserta) as $skk){
                    foreach($skk as $kk){
                        $sifat = in_array($kk->subklasifikasi, $subklas) == true ? 1 : 0.8;
                        PenilaianPeserta::query()->create([
                            'id_kegiatan' => $kegiatan->uuid,
                            'id_unsur' => $item->unsur_peserta,
                            'nik' => $item->nik_peserta,
                            'id_sub_bidang' => $kk->id_sub_bidang,
                            'is_jenis' => $jenis,
                            'is_sifat' => $sifat,
                            'is_metode' => $metode,
                            'is_tingkat' => $tingkat,
                            'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                        ]);
                    }
                }

                foreach(GetSKA::run($item->nik_peserta) as $sub){
                    foreach($sub as $s){
                        PenilaianPeserta::query()->create([
                            'id_kegiatan' => $kegiatan->uuid,
                            'id_unsur' => $item->unsur_peserta,
                            'nik' => $item->nik_peserta,
                            'id_sub_bidang' => $s->id_sub_bidang,
                            'is_jenis' => $jenis,
                            'is_sifat' => $sifat,
                            'is_metode' => $metode,
                            'is_tingkat' => $tingkat,
                            'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                        ]);
                    }
                }
                
            }
        });
    }

    public function validasiKegiatan(Request $request, $uuid){
        $kegiatan = Kegiatan::with(['user','nilaiPelaporan', 'nilaiPelaporan.unsur' ,'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('uuid', $uuid)->first();
        $user = User::find($kegiatan->user_id);
        DB::transaction(function () use($request, $kegiatan, $user){
             $kegiatan->update([
                'status_permohonan_kegiatan' => PermohonanStatus::VALIDASI,
                'keterangan_verifikasi' => $request->keterangan_verifikasi
            ]);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::VALIDASI,
                'keterangan' => 'kegiatan terverifikasi',
                'user' => 1
            ]);

            Notification::send($user, new ValidasiNotification($kegiatan));
        });
    }

    public function pelaporan(Request $request){
        $data = Kegiatan::find($request->id);
        $user = User::find($data->user_id);
        $laporan = PelaporanKegiatan::where('id_kegiatan', $data->uuid)->first();
        DB::transaction(function () use($request, $data, $user, $laporan){
            $data->update([
                'status_permohonan_kegiatan' => PermohonanStatus::PERBAIKAN_PELAPORAN,
                'status_permohonan_penyelenggara' => PermohonanStatus::PERBAIKAN_PELAPORAN,
            ]);

            $laporan->update([
                'status_laporan' => PermohonanStatus::OPEN
            ]);
 
            $item = LogKegiatan::query()->create([
                'id_kegiatan' => $data->uuid,
                'status_permohonan' => PermohonanStatus::PERBAIKAN_PELAPORAN,
                'keterangan' => $request->keterangan,
                'user' => Auth::user()->id
            ]);

            Notification::send($user, new PerbaikanPelaporanNotification($item));
        });
    }

    public function pengesahan(Request $request, $uuid){
        $kegiatan = Kegiatan::where('uuid', $uuid)->first();
        $user = User::find($kegiatan->user_id);
        DB::transaction(function () use($request, $kegiatan, $uuid, $user){
            $kegiatan->update([
                'status_permohonan_kegiatan' => PermohonanStatus::PENGESAHAN,
                'keterangan_pengesahan' => $request->keterangan_pengesahan,
                'tgl_penilaian' => Carbon::now(),
                'is_verifikasi' => 1
            ]);

            $this->penilaianPeserta($uuid);

            LogKegiatan::query()->create([
                'id_kegiatan' => $kegiatan->uuid,
                'status_permohonan' => PermohonanStatus::PENGESAHAN,
                'keterangan' => 'kegiatan sudah pengesahan',
                'user' => Auth::user()->id
            ]);

            Notification::send($user, new TerverifikasiNotification($kegiatan));
        });
    }

    public function penilaianAPI(Request $request, $uuid){
        $kegiatan = KegiatanAPI::with(['peserta'])->where('uuid', $uuid)->first();

        DB::transaction(function () use($request, $kegiatan){           
            foreach($kegiatan->peserta as $item){

                $peserta = PesertaAPI::find($item->id);

                $peserta->update([
                    'is_sah' => true
                ]);

                $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($item->unsur);

                $tingkat = 1;
                $jenis = 1;
                $metode = $item->metode == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
                $sifat = $unsurKegiatan->bobot->khusus;

                if($kegiatan->tingkat_kegiatan === "1"){
                    $tingkat = $unsurKegiatan->bobot->nasional;
                }elseif($kegiatan->tingkat_kegiatan === "2"){
                    $tingkat = $unsurKegiatan->bobot->internasional_dalam_negeri;
                }else{
                    $tingkat = $unsurKegiatan->bobot->internasional_luar_negeri;
                }

                $subklas = explode(',', $kegiatan->subklasifikasi);

                foreach(GetSKK::run($item->nik) as $skk){
                    foreach($skk as $kk){
                        $sifat = in_array($kk->klasifikasi, $subklas) == true ? 1 : 0.8;
                        PenilaianAPI::query()->create([
                            'id_kegiatan' => $kegiatan->uuid,
                            'id_unsur' => $item->unsur,
                            'nik' => $item->nik,
                            'id_sub_bidang' => $kk->id_sub_bidang,
                            'is_jenis' => $jenis,
                            'is_sifat' => $sifat,
                            'is_metode' => $metode,
                            'is_tingkat' => $tingkat,
                            'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                        ]);
                    }
                }

                foreach(GetSKA::run($item->nik) as $sub){
                    foreach($sub as $s){
                        PenilaianAPI::query()->create([
                            'id_kegiatan' => $kegiatan->uuid,
                            'id_unsur' => $item->unsur,
                            'nik' => $item->nik,
                            'id_sub_bidang' => $s->id_sub_bidang,
                            'is_jenis' => $jenis,
                            'is_sifat' => $sifat,
                            'is_metode' => $metode,
                            'is_tingkat' => $tingkat,
                            'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                        ]);
                    }
                }
            }
        });
    }

    public function allNilai(){
        $data = PesertaAPI::whereNull('is_sah')->get();

        foreach($data as $item){
            $item->update([
                'is_sah' => true
            ]);

            $unsurKegiatan = MtSubUnsurKegiatan::with(['bobot'])->find($item->unsur);
            $kegiatan = KegiatanAPI::find($item->id_peserta);

            $tingkat = 1;
            $jenis = 1;
            $metode = $item->metode == 'Tatap Muka' ? $unsurKegiatan->bobot->tatap_muka : $unsurKegiatan->bobot->daring;
            $sifat = $unsurKegiatan->bobot->khusus;

            $subklas = explode(',', $kegiatan->subklasifikasi);

            foreach(GetSKK::run($item->nik) as $skk){
                foreach($skk as $kk){
                    $sifat = in_array($kk->subklasifikasi, $subklas) == true ? 1 : 0.8;
                    PenilaianAPI::query()->create([
                        'id_kegiatan' => $kegiatan->uuid,
                        'id_unsur' => $item->unsur,
                        'nik' => $item->nik,
                        'id_sub_bidang' => $kk->id_sub_bidang,
                        'is_jenis' => $jenis,
                        'is_sifat' => $sifat,
                        'is_metode' => $metode,
                        'is_tingkat' => $tingkat,
                        'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                    ]);
                }
            }

            foreach(GetSKA::run($item->nik) as $sub){
                foreach($sub as $s){
                    PenilaianAPI::query()->create([
                        'id_kegiatan' => $kegiatan->uuid,
                        'id_unsur' => $item->unsur,
                        'nik' => $item->nik,
                        'id_sub_bidang' => $s->id_sub_bidang,
                        'is_jenis' => $jenis,
                        'is_sifat' => $sifat,
                        'is_metode' => $metode,
                        'is_tingkat' => $tingkat,
                        'angka_kredit' => $unsurKegiatan->nilai_skpk * ($jenis == null ? 1 : (float)$jenis) * ($sifat == null ? 1 : (float)$sifat) * ($metode == null ? 1 : (float)$metode) * ($tingkat == null ? 1 : (float)$tingkat)
                    ]);
                }
            }
        }
    }

    
}
