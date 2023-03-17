<?php

namespace App\Services\Peserta;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesertaService
{
    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            $peserta = PesertaKegiatan::where('nik_peserta', $request->nik)->first();

            if(!empty($peserta) && $peserta->nik_peserta == $request->nik && $peserta->id_kegiatan == $request->id_kegiaatan){
                return 'pesert sudah di catatkan';
            }

            PesertaKegiatan::query()->create([
                'uuid' => Uuid::uuid4()->toString(),
                'id_kegiatan' => $request->id_kegiatan,
                'nik_peserta' => $request->nik,
                'unsur_peserta' => $request->unsur,
                'metode_peserta' => $request->metode,
                'user_id' => Auth::user()->id
            ]);
        });
    }

    public function update(Request $request, $id)
    {
        $peserta = PesertaKegiatan::find($id);
        DB::transaction(function () use($peserta, $request){
            $peserta->update([
                'nik_peserta' => $request->nik,
                'unsur_peserta' => $request->unsur,
                'metode_peserta' => $request->metode
            ]);
        });
    }

    public function delete($id){
        $peserta = PesertaKegiatan::find($id);
        DB::transaction(function () use($peserta){
            $peserta->delete();
        });
    }
}
