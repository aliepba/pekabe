<?php

namespace App\Models\Pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAPI extends Model
{
    use HasFactory;

    protected $table = 'pkb_penilaian_api';

    protected $guarded = [];
}
