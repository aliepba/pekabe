<?php

namespace App\Http\Resources\Kegiatan;

use App\Enums\DateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'penyelenggara_lain' => $this->penyelenggara_lain,
            'subklasifikasi' => $this->subklasifikasi,
            'penilai' => $this->penilai,
            'unsur_kegiatan' => $this->unsur_kegiatan,
            'metode_kegiatan' => $this->metode_kegiatan,
            'tingkat_kegiatan' => $this->tingkat_kegiatan,
            'jenis_kegiatan' => $this->jenis_kegiatan,
            'tgl_pengajuan' => $this->tgl_pengajuan,
            'nama_kegiatan' => $this->nama_kegiatan,
            'tempat_kegiatan' => $this->tempat_kegiatan,
            'start_kegiatan' => $this->start_kegiatan,
            'end_kegiatan' => $this->end_kegiatan,
            'surat_permohonan' => $this->surat_permohonan,
            'tor_kak' => $this->tor_kak,
            'sk_panitia' => $this->sk_panitia,
            'cv' => $this->cv,
            'persyaratan_lain' => $this->persyaratan_lain,
            'persyaratan_lain_lain' => $this->persyaratan_lain_lain,
            'status_permohonan_kegiatan' => $this->status_permohonan_kegiatan,
            'status_permohonan_penyelenggara' => $this->status_permohonan_penyelenggara,
            'id_penyelenggara' => $this->id_penyelenggara,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'updated_at' => $this->updated_at->format(DateFormat::WITH_TIME),
        ];
    }
}
