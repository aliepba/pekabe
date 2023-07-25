<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIJKT extends Model
{
    use HasFactory;

    protected $connection = 'simpan';

    protected $table = 'sijkt_sso';

    protected $guarded = [];
}
