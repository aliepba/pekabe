<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UnsurKegiatanPenyelenggara extends Model
{
    use HasFactory;

    protected $table = 'pkb_unsur_kegiatan_penyelenggara';

    protected $guarded = [];

    public function unsur(){
            return $this->hasOne(MtSubUnsurKegiatan::class, 'id', 'id_unsur');
    }
}
