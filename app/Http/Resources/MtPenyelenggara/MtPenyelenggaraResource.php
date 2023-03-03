<?php

namespace App\Http\Resources\MtPenyelenggara;

use App\Enums\DateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class MtPenyelenggaraResource extends JsonResource
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
            'jenis_penyelenggara' => $this->jenis_penyelenggara,
            'deleted_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'created_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'updated_at' => $this->updated_at->format(DateFormat::WITH_TIME),
        ];
    }
}
