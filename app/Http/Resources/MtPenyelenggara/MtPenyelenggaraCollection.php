<?php

namespace App\Http\Resources\MtPenyelenggara;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MtPenyelenggaraCollection extends ResourceCollection
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
            'data' => MtPenyelenggaraResource::collection($this->collection)
        ];
    }
}
