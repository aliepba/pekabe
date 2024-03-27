<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapSKK extends Model
{
    use HasFactory;

    protected $table = 'pkb_rekap_skk';

    protected $guarded = [];
}
