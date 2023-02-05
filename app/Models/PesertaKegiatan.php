<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PesertaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pkb_peserta_kegiatan';

    protected $guarded = [];

    public function unsur(){
        return $this->hasOne(MtSubUnsurKegiatan::class, 'id', 'unsur_peserta');
    }
}
