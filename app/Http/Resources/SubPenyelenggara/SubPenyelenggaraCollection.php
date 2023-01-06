<?php

namespace App\Http\Resources\SubPenyelenggara;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubPenyelenggaraCollection extends ResourceCollection
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
            'data' => SubPenyelenggaraResource::collection($this->collection)
        ];
    }
}
