<?php

namespace App\Imports;

use App\Models\UploadPeserta;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class PesertaImport implements ToModel
{
     private $idKegiatan;

    public function __construct($idKegiatan)
    {
        $this->idKegiatan = $idKegiatan;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UploadPeserta([
            'id_kegiatan' => $this->idKegiatan,
            'nik' => $row[1],
            'metode' => $row[2],
            'user_id' => Auth::user()->id
        ]);
    }
}
