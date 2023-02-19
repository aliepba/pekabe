<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MtBobotPenilaian extends Model
{
    use HasFactory;

    protected $table = 'pkb_bobot_penilai';

    protected $guarded = [];

}
