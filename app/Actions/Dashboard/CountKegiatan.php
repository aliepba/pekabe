<?php

namespace App\Actions\Dashboard;

use App\Models\Kegiatan;
use App\Models\DetailInstansi;
use App\Enums\PermohonanStatus;
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
            'all' => Kegiatan::all()->count(),
            'setuju' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)->count(),
            'tolak' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)->count(),
            'pelaporan' => DB::select("SELECT COUNT(a.uuid) AS jumlah FROM pkb_kegiatan_penyelenggara a
                                JOIN pkb_pelaporan_kegiatan b on a.uuid = b.id_kegiatan
                                WHERE b.status_laporan = 'SUBMIT'"),
            'tolakPenyelenggara' => DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)->count(),
            'sah' => Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)->count()
        ];
    }
}
