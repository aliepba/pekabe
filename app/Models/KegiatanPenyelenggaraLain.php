<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPenyelenggaraLain extends Model
{
    use HasFactory;

    protected $table = 'pkb_kegiatan_penyelenggara_lain';

    protected $guarded = [];

    public function userPenyelenggara(){
        return $this->hasOne(DetailInstansi::class, 'id', 'id_penyelenggara');
    }
}
