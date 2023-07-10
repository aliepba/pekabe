<?php

namespace App\Models\Pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAPI extends Model
{
    use HasFactory;

    protected $table = 'pkb_pelaporan_api';

    protected $guarded = [];
}
