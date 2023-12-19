<?php

namespace App\Actions\Dashboard;

use App\Models\Kegiatan;
use App\Models\DetailInstansi;
use App\Enums\PermohonanStatus;
use App\Models\KegiatanPenyelenggaraLain;
use App\Models\PelaporanKegiatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Cache;

class CountKegiatan
{
    use AsAction;

    public function handle():array
    {
        return [
            'user' =>  Cache::remember('user', now()->addHours(6) , function(){return DetailInstansi::where('status_permohonan', 'APPROVE')->count();}),
            'all' => Cache::remember('all', now()->addHours(6) , function () {return Kegiatan::whereNotIn('status_permohonan_kegiatan', ['OPEN'])->count();}),
            'kolaborasi' => Cache::remember('kolaborasi',now()->addHours(6), function(){return KegiatanPenyelenggaraLain::count();}),
            'setuju' => Cache::remember('setuju', now()->addHours(6), function(){return Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->count();}),
            'tolak' => Cache::remember('tolak', now()->addHours(6), function(){return Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)->count();}),
            'tolakPenyelenggara' => Cache::remember('tolakPenyelenggara', now()->addHours(6) ,function(){return DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)->count();}),
            'sah' => Cache::remember('sah', now()->addHours(6), function(){return Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)->count();}),
            'akun' => Cache::remember('akun', now()->addHours(6), function(){return User::whereIn('role', ['user', 'sub-user'])->count();}),
            'pelaporan' => Cache::remember('pelaporan', now()->addHours(6), function(){return PelaporanKegiatan::where('status_laporan', PermohonanStatus::SUBMIT)->count();}),
            'usertk' => Cache::remember('usertk', now()->addHours(6), function(){return User::where('role', 'skk-ska')->count();}),
            // 'jenjang' => DB::SELECT("SELECT a.jenjang_id , count(b.id) as total_skpk FROM lsp_jabatan_kerja a
            //                     LEFT JOIN pkb_penilaian_peserta b ON b.id_sub_bidang = a.id_jabatan_kerja 
            //                     COLLATE utf8mb4_unicode_ci
            //                     where a.jenjang_id in ('7','8', '9') group by a.jenjang_id")
        ];
    }
}
