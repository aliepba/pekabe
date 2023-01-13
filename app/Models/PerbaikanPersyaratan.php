<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanPersyaratan extends Model
{
    use HasFactory;

    protected $table = 'perbaikan_persyaratan_kegiatan';

    protected $guarded = [];
}