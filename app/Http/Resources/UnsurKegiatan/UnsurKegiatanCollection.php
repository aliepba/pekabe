<?php

namespace App\Http\Resources\UnsurKegiatan;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnsurKegiatanCollection extends ResourceCollection
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
            'data' => UnsurKegiatanResource::collection($this->collection)
        ];
    }
}
