<?php

namespace App\Actions\Referensi;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Pengembangan\PenilaianAPI;

class GetNilaiPengembangan
{
    use AsAction;

    public function handle($id, $nik, $unsur)
    {
        $nilai = PenilaianAPI::where('id_kegiatan', $id)
                            ->where('nik', $nik)
                            ->where('id_unsur', $unsur)
                            ->first('angka_kredit');

        return $nilai == null ? '-' : $nilai->angka_kredit;
    }
}
