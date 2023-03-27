<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetLogKegiatan
{
    use AsAction;

    public function handle()
    {
        return [
            'kegiatan' => DB::select("SELECT
                            id_log,
                            id_sub_bidang,
                            kegiatan_ke,
                            nama_kegiatan,
                            mulai_kegiatan,
                            selesai_kegiatan,
                            jumlah_jam,id_kegiatan,
                            id_sub_kegiatan,
                            id_klasifikasi_peran,
                            prakiraan_skpk
                            FROM log_kegiatan_pkb WHERE id_personal IN ('". Auth::user()->nik ."')
                        ")
        ];
    }
}
