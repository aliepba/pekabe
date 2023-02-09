<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Kegiatan\GetPKBV1;

class Pkbv1Controller extends Controller
{
    public function kegiatanTerverifikasi()
    {
        return view('pages.kegiatan.pkb-v1', GetPKBV1::run());
    }
}
