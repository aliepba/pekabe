<?php

namespace App\Services\Peserta;

use Ramsey\Uuid\Uuid;
use App\Imports\PesertaImport;
use Illuminate\Http\Request;
use App\Models\ExcelPeserta;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use App\Models\UploadPeserta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UploadService
{
    public function import(Request $request, $idKegiatan){
        $file = $request->file('excel');

        $nama_file = rand().Auth::user()->id.$file->getClientOriginalName();

        $file->move('excel_peserta', $nama_file);

        Excel::import(new PesertaImport($idKegiatan), public_path('/excel_peserta/'.$nama_file));
    }

    public function update(Request $request, $id){
        $peserta = UploadPeserta::find($id);
        DB::transaction(function () use($request, $peserta){
           $peserta->update([
                'nik' => $request->nik,
                'unsur_peserta' => $request->unsur,
                'metode' => $request->metode == null ? $peserta->metode : $request->metode,
           ]);
        });

        return $peserta;
    }

    public function delete($id){
        $peserta = UploadPeserta::find($id);
        DB::transaction(function () use($peserta){
            $peserta->delete();
        });
    }

    public function acc($id){
        $peserta = UploadPeserta::find($id);

        if (preg_match('/[a-zA-Z\p{P}]/u', $peserta->nik)) {
            return redirect(route('excel', $peserta->id_kegiatan))->with('error', 'Harap input NIK bukan Nama.');
        }

        DB::transaction(function () use($peserta){
            $peserta->update([
                'acc' => 1
            ]);

            PesertaKegiatan::query()->create([
                'uuid' => Uuid::uuid4()->toString(),
                'id_kegiatan' => $peserta->id_kegiatan,
                'nik_peserta' => $peserta->nik,
                'unsur_peserta' => $peserta->unsur_peserta,
                'metode_peserta' => $peserta->metode,
                'user_id' => Auth::user()->id
            ]);
        });
    }
}
