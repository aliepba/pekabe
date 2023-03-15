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

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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

    public function unsurKegiatan(){
        return $this->hasMany(UnsurKegiatanPenyelenggara::class, 'id_kegiatan', 'uuid');
    }

    public function nilaiPelaporan(){
        return $this->hasMany(PenilaianKegiatan::class, 'uuid', 'uuid');
    }

    public function nilaiValidasi(){
        return $this->hasOne(PenilaianValidator::class, 'id_kegiatan', 'uuid');
    }

    public function penyelenggaraLain(){
        return $this->hasMany(KegiatanPenyelenggaraLain::class, 'id_kegiatan', 'uuid');
    }

    public function excelPeserta(){
        return $this->hasMany(UploadPeserta::class, 'id_kegiatan', 'uuid');
    }

    // public function unsur(){
    //     return $this->belongsTo(MtSubUnsurKegiatan::class, 'unsur_kegiatan', 'id');
    // }
}
