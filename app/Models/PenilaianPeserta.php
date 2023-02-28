<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    use HasFactory;

    protected $table = 'pkb_penilaian_peserta';

    protected $guarded = [];
}
