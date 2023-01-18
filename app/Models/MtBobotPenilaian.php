<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtBobotPenilaian extends Model
{
    use HasFactory;

    protected $table = 'pkb_bobot_penilai';

    protected $guarded = [];
}
