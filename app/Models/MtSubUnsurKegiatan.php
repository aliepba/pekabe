<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MtSubUnsurKegiatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table  = 'pkb_sub_unsur_kegiatan';

    protected $guarded = [];

    public function jenisKegiatan(){
        return $this->belongsTo(MtUnsurKegiatan::class, 'id_unsur_kegiatan' , 'id');
    }

    public function bobot(){
        return $this->hasOne(MtBobotPenilaian::class, 'id',  'id_bobot_penilaian');
    }
}
