<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pkb_penilaian_kegiatan';

    protected $guarded = [];
}
