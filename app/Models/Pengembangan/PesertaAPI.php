<?php

namespace App\Models\Pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MtSubUnsurKegiatan;

class PesertaAPI extends Model
{
    use HasFactory;

    protected $table = 'pkb_peserta_api';

    protected $guarded = [];

    public function subUnsur(){
        return $this->hasOne(MtSubUnsurKegiatan::class, 'id', 'unsur');
    }
}
