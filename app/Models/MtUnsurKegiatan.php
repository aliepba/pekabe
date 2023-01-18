<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtUnsurKegiatan extends Model
{
    use HasFactory;

    protected $table = 'master_unsur_kegiatan';

    protected $guarded = [];

    public function subUnsur(){
        return $this->hasMany(MtSubUnsurKegiatan::class, 'id_unsur_kegiatan', 'id');
    }
}
