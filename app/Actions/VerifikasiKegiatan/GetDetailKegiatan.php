<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetDetailKegiatan
{
    use AsAction;

    public function handle($id_hash)
    {
        
        $id = Kegiatan::Decrypt($id_hash);

        $peserta = DB::SELECT("select a.id, b.nama as skk, c.Nama  as ska, a.nik_peserta, a.unsur_peserta as unsur, a.metode_peserta  from pkb_peserta_kegiatan a
        left join lsp_personal b on a.nik_peserta = b.nik COLLATE utf8mb4_unicode_ci
        left join personal c on a.nik_peserta = c.id_personal
        join pkb_sub_unsur_kegiatan d on a.unsur_peserta = d.id
        where a.id = '$id'");

        return [
            'data' => Kegiatan::with(['validator',
                                        'unsurKegiatan',
                                        'unsurKegiatan.unsur',
                                        'user', 'penyelenggaraLain', 'penyelenggaraLain.userPenyelenggara'])
                                        ->where('id', $id)->first(),
            'peserta' => $peserta
        ];
    }
}
