<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormAbsenController extends Controller
{
    public function index($uuid)
    {
        return view('pages.kegiatan.form-peserta', [
            'data' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $uuid)->first()
        ]);
    }
}
