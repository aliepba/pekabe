<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table= 'kegiatan_penyelenggara';

    protected $guarded = [];

    public function validator(){
        return $this->hasOne(MtAsosiasiProfesi::class, 'ID_Asosiasi_Profesi', 'penilai');
    }

    public function timeline(){
        return $this->hasMany(LogKegiatan::class, 'id_kegiatan' , 'uuid');
    }
}
