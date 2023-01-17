<?php

namespace App\Http\Resources\UnsurKegiatan;

use App\Enums\DateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UnsurKegiatanResource extends JsonResource
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
            'unsur_kegiatan' => $this->unsur_kegiatan,
            'created_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'updated_at' => $this->updated_at->format(DateFormat::WITH_TIME),
            'deleted_at' => $this->updated_at->format(DateFormat::WITH_TIME)
        ];
    }
}
