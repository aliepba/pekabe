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

class CountKegiatan
{
    use AsAction;

    public function handle():array
    {
        return [
            'user' => DetailInstansi::where('status_permohonan', 'APPROVE')->count(),
            'all' => Kegiatan::whereNotIn('status_permohonan_kegiatan', ['OPEN'])->count(),
            'kolaborasi' => KegiatanPenyelenggaraLain::count(),
            'setuju' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->count(),
            'tolak' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)->count(),
            // 'pelaporan' => DB::select("SELECT COUNT(a.uuid) AS jumlah FROM pkb_kegiatan_penyelenggara a
            //                     JOIN pkb_pelaporan_kegiatan b on a.uuid = b.id_kegiatan
            //                     WHERE b.status_laporan = 'SUBMIT'"),
            'tolakPenyelenggara' => DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)->count(),
            'sah' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)->count(),
            'akun' => User::whereIn('role', ['user', 'sub-user'])->count(),
            'pelaporan' => PelaporanKegiatan::where('status_laporan', PermohonanStatus::SUBMIT)->count(),
            'usertk' => User::where('role', 'skk-ska')->count(),
            'jenjang' => DB::SELECT("SELECT a.jenjang_id , count(b.id) as total_skpk FROM lsp_jabatan_kerja a
                                LEFT JOIN pkb_penilaian_peserta b ON b.id_sub_bidang = a.id_jabatan_kerja COLLATE utf8mb4_unicode_ci
                                where a.jenjang_id in ('7','8', '9') group by a.jenjang_id"),
        ];
    }
}
