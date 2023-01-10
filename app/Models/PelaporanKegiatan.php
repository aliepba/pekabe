<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_kegiatan';

    protected $guarded = [];
}
