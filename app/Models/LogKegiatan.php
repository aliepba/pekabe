<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogKegiatan extends Model
{
    use HasFactory;

    protected $table= 'log_kegiatan';

    protected $guarded = [];
}
