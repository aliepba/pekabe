<?php

namespace App\Models;

use App\Services\Peserta\PesertaService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table= 'pkb_kegiatan_penyelenggara';

    protected $guarded = [];

    public function validator(){
        return $this->hasOne(MtAsosiasiProfesi::class, 'ID_Asosiasi_Profesi', 'penilai');
    }

    public function timeline(){
        return $this->hasMany(LogKegiatan::class, 'id_kegiatan' , 'uuid');
    }

    public function peserta(){
        return $this->hasMany(PesertaKegiatan::class, 'id_kegiatan', 'uuid');
    }

    public function laporan(){
        return $this->hasOne(PelaporanKegiatan::class, 'id_kegiatan', 'uuid');
    }

    public function jenis(){
        return $this->belongsTo(MtUnsurKegiatan::class, 'jenis_kegiatan', 'id');
    }

    public function unsur(){
        return $this->belongsTo(MtSubUnsurKegiatan::class, 'unsur_kegiatan', 'id');
    }

    public function nilaiPelaporan(){
        return $this->hasOne(PenilaianKegiatan::class, 'uuid', 'uuid');
    }

    public function nilaiValidasi(){
        return $this->hasOne(PenilaianValidator::class, 'id_kegiatan', 'uuid');
    }
}
