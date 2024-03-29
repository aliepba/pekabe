<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInstansi extends Model
{
    use HasFactory;

    protected $table = 'pkb_detail_instansi';

    protected $guarded = [];
    
    public function Jenispenyelenggara(){
        return $this->belongsTo(MtPenyelenggara::class, 'jenis', 'id');
    }

    public function penanggungjawab(){
        return $this->hasOne(PenanggungJawab::class, 'id_detail_instansi', 'uuid');
    }

    public function provinsi(){
        return $this->hasOne(MtProvinsi::class, 'id_propinsi_dagri', 'propinsi');
    }

    public function kabKota(){
        return $this->hasOne(MtKabKota::class, 'id_kabupaten_dagri', 'kab_kota');
    }


    public function asosiasiProfesi(){
        return $this->hasOne(MtAsosiasiProfesi::class, 'ID_Asosiasi_Profesi', 'penyelenggara');
    }

    public function asosiasiBadanUsaha(){
        return $this->hasOne(MtAsosiasiBadanUsaha::class, 'ID_Asosiasi_BU', 'penyelenggara');
    }
}
