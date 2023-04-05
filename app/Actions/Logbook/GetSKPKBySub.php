<?php

namespace App\Actions\Logbook;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSKPKBySub
{
    use AsAction;

    public function handle($idSub)
    {
        $sum = BD::SELECT("SELECT sum(angka)");
    }
}
