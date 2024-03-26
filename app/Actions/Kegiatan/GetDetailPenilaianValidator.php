<?php

namespace App\Actions\Kegiatan;

use App\Models\Kegiatan;
use App\Models\MtBobotPenilaian;
use App\Models\PesertaKegiatan;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class GetDetailPenilaianValidator
{
    use AsAction;

    public function handle($id_hash):array
    {
        $id = Kegiatan::Decrypt($id_hash);
        $kegiatan = Kegiatan::with(['nilaiPelaporan', 'nilaiPelaporan.unsur' ,'jenis', 'unsurKegiatan', 'unsurKegiatan.unsur'])->where('id', $id)->first();
        $peserta = DB::SELECT("select a.id, b.nama as skk, c.Nama  as ska, a.nik_peserta, d.nama_sub_unsur as unsur, a.metode_peserta  from pkb_peserta_kegiatan a
        left join lsp_personal b on a.nik_peserta = b.nik COLLATE utf8mb4_unicode_ci
        left join personal c on a.nik_peserta = c.id_personal
        join pkb_sub_unsur_kegiatan d on a.unsur_peserta = d.id
        where a.id_kegiatan = '$kegiatan->uuid' and a.deleted_at is NULL" );
        // $idUnsur = [];
        // foreach ($kegiatan->unsurKegiatan as $unsurKegiatan){
        //     $idUnsur[] = $unsurKegiatan->unsur->id_bobot_penilaian;
        // }
        return [
            'data' => $kegiatan,
            // 'peserta' => $peserta
            // 'bobot' => MtBobotPenilaian::whereIn('id', $idUnsur)->get(),
            'peserta' => PesertaKegiatan::where('id_kegiatan', $kegiatan->uuid)->paginate(10)
        ];
    }
}
