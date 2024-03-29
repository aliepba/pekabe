<?php

namespace App\Actions\VerifikasiKegiatan;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Resources\Kegiatan\KegiatanCollection;

class GetByApt
{
    use AsAction;

    public function handle()
    {
        return [
            'data' =>  new KegiatanCollection (Kegiatan::with(['validator'])
                    ->where('penilai', Auth::user()->jenis)
                    ->where('status_permohonan_kegiatan', 'SUBMIT')->get())
        ];
    }
}
