<?php

namespace App\Http\Resources\Kegiatan;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KegiatanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => KegiatanResource::collection($this->collection)
        ];
    }
}
