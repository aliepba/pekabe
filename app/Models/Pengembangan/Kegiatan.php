<?php

namespace App\Models\Pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnsurKegiatanPenyelenggara;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'pkb_kegiatan_api';

    protected $guarded = [];

    public function asosiasi(){
        return $this->belongsTo(UserAPI::class, 'user_id', 'id');
    }

    public function laporan(){
        return $this->hasOne(LaporanAPI::class, 'id_kegiatan', 'uuid');
    }

    public function peserta(){
        return $this->hasMany(PesertaAPI::class, 'id_kegiatan', 'uuid');
    }

    public function unsurKegiatan(){
        return $this->hasMany(UnsurKegiatanPenyelenggara::class, 'id_kegiatan', 'uuid');
    }
}
