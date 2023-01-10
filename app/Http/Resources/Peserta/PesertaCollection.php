<?php

namespace App\Http\Resources\Peserta;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PesertaCollection extends ResourceCollection
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
            'data' => PesertaResource::collection($this->collection)
        ];
    }
}
