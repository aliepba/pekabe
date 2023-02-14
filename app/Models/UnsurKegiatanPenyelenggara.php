<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsurKegiatanPenyelenggara extends Model
{
    use HasFactory;

    protected $table = 'pkb_unsur_kegiatan_penyelenggara';

    protected $guarded = [];
}
