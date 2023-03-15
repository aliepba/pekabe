<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPeserta extends Model
{
    use HasFactory;

    protected $table = 'pkb_upload_peserta';

    protected $guarded = [];

    public function unsur(){
        return $this->hasOne(MtSubUnsurKegiatan::class, 'id', 'unsur_peserta');
    }
}
