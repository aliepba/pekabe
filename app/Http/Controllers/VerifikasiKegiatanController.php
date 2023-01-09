<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class VerifikasiKegiatanController extends Controller
{
    public function list()
    {
        return view('pages.verifikasi-kegiatan.list', [
            'data' => Kegiatan::with(['validator'])->where('penilai', 000)->get()
        ]);
    }

    public function detail($uuid)
    {
        return view('pages.verifikasi-kegiatan.detail', [
            'data' => Kegiatan::with(['validator'])->where('uuid', $uuid)->first()
        ]);
    }

    public function komenSurat(Request $request)
    {

    }
}
