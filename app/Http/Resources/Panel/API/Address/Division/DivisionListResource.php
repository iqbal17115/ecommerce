<?php

namespace App\Http\Resources\Panel\API\Address\Division;

use Illuminate\Http\Resources\Json\JsonResource;

class DivisionListResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}
