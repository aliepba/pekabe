<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelPeserta extends Model
{
    use HasFactory;

    protected $table = 'pkb_excel_peserta';

    protected $guarded = [];
}
