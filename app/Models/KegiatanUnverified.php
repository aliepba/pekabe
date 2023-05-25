<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanUnverified extends Model
{
    use HasFactory;

    protected $table = 'pkb_kegiatan_unverified';

    protected $guarded = [];

    public function penilaian(){
        return $this->hasOne(PenilaianKegiatan::class, 'uuid', 'uuid');
    }

     public function jenis(){
        return $this->belongsTo(MtUnsurKegiatan::class, 'jenis_kegiatan', 'id');
    }

    public function unsur(){
        return $this->belongsTo(MtSubUnsurKegiatan::class, 'id_unsur_kegiatan', 'id');
    }
}


