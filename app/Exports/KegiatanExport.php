<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KegiatanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $kegiatan = DB::table('pkb_kegiatan_penyelenggara as a')
                        ->join('pkb_users as b', 'a.user_id', '=', 'b.id')
                        ->join('pkb_unsur_kegiatan_penyelenggara as c', 'a.uuid', '=', 'c.id_kegiatan')
                        ->join('pkb_sub_unsur_kegiatan as d', 'c.id_unsur', '=', 'd.id')
                        ->select('b.name', 'a.nama_kegiatan', 'a.status_permohonan_kegiatan',
                         'a.tgl_pengajuan', 'a.start_kegiatan', 'a.end_kegiatan',
                          'a.subklasifikasi','d.nama_sub_unsur', 'a.metode_kegiatan',
                          'a.tingkat_kegiatan', 'a.keterangan')
                        ->get();

        return $kegiatan;
    }

    public function headings(): array
    {
        return [
            'penyelenggara',
            'nama kegiatan',
            'status kegiatan',
            'tanggal pengajuan',
            'tanggal mulai',
            'tanggal selesai',
            'subklasifikasi',
            'unsur',
            'metode',
            'tingkat',
            'keterangan'
        ];
    }
}
