<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pkb_setting_pengajuan_kegiatan';

    protected $guarded = [];
}
