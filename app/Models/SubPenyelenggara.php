<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubPenyelenggara extends Model
{
    use HasFactory;

    protected $table = 'pkb_sub_penyelenggara';

    protected $guarded = [];

    public function propinsi(){
        return $this->hasOne(MtProvinsi::class, 'id_propinsi_dagri', 'id_propinsi');
    }

}

