<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Enums\PermohonanStatus;
use App\Models\PelaporanKegiatan;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPenilaianValidator
{
    use AsAction;

    public function handle():array
    {
        return [
            'data' => Kegiatan::leftJoin('pkb_pelaporan_kegiatan', 'pkb_kegiatan_penyelenggara.uuid', '=', 'pkb_pelaporan_kegiatan.id_kegiatan')
                            ->with(['user', 'laporan'])
                            ->where('pkb_kegiatan_penyelenggara.status_permohonan_kegiatan', '=', PermohonanStatus::PELAPORAN)
                            ->where('is_open', false)
                            ->orderBy('pkb_pelaporan_kegiatan.updated_at', 'asc')
                            ->get(),
        ];
    }
}
