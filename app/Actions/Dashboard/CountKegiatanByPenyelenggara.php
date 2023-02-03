<?php

namespace App\Actions\Dashboard;

use App\Models\Kegiatan;

use App\Enums\PermohonanStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class CountKegiatanByPenyelenggara
{
    use AsAction;

    public function handle():array
    {
        return [
            'allByUser' => Kegiatan::where('user_id', Auth::user()->id)->count(),
            'setujuByUser' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->where('user_id', Auth::user()->id)->count(),
            'tolakByUser' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)->where('user_id', Auth::user()->id)->count(),
            'pelaporanByUser' => DB::select("SELECT COUNT(a.uuid) AS jumlah FROM pkb_kegiatan_penyelenggara a
                                            JOIN pkb_pelaporan_kegiatan b on a.uuid = b.id_kegiatan
                                            WHERE b.status_laporan = 'SUBMIT'
                                            AND a.user_id =" . Auth::user()->id. ""),
            'unverified' => Kegiatan::where('is_verifikasi', 0)->where('user_id', Auth::user()->id)->count(),
        ];
    }
}
