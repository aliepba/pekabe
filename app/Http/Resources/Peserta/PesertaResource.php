<?php

namespace App\Http\Resources\Peserta;

use App\Enums\DateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class PesertaResource extends JsonResource
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
            'nik_peserta' => $this->nik_peserta,
            'unsur_peserta' => $this->unsur_peserta,
            'metode_peserta' => $this->metode_peserta,
            'created_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'updated_at' => $this->updated_at->format(DateFormat::WITH_TIME),
            'deleted_at' => $this->updated_at->format(DateFormat::WITH_TIME)
        ];
    }
}
