<?php

namespace App\Actions\Kegiatan;

use App\Http\Resources\Kegiatan\KegiatanCollection;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;

class GetKegiatanPenyelenggara
{
    use AsAction;

    public function handle():array
    {
        return [
            'kegiatan' => new KegiatanCollection(
                Kegiatan::where('user_id', Auth::user()->id)
                        ->where(function($query){
                            $query->where('status_permohonan_kegiatan', 'OPEN')
                                ->orWhere('status_permohonan_kegiatan', 'SUBMIT');
                        })->get()
            )
        ];
    }
}
