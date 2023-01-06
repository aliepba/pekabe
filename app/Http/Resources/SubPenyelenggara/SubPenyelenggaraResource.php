<?php

namespace App\Http\Resources\SubPenyelenggara;

use App\Enums\DateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class SubPenyelenggaraResource extends JsonResource
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
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon'  => $this->telepon,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
            'deleted_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'created_at' => $this->created_at->format(DateFormat::WITH_TIME),
            'updated_at' => $this->updated_at->format(DateFormat::WITH_TIME),
        ];
    }
}
