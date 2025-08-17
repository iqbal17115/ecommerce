<?php

namespace App\Http\Resources\AdminPanel\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;

class InsideOutsideResource extends JsonResource
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
            'id'               => $this->id,
            'shipping_zone_id' => $this->shipping_zone_id,
            'inside_rate'      => $this->inside_rate,
            'outside_rate'     => $this->outside_rate,
        ];
    }
}
