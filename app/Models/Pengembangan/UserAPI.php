<?php

namespace App\Models\Pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAPI extends Model
{
    use HasFactory;

    protected $table = 'pkb_user_api';

    protected $guarded = [];

    public function kegiatan(){
        return $this->hasMany(Kegiatan::class, 'user_id', 'id');
    }
}
