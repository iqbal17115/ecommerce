<?php

namespace App\Http\Resources\AdminPanel\ShippingZoneLocation;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingZoneLocationListResource extends JsonResource
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
            'shipping_zone_name' => $this->shippingZone?->name,
            'division_name' => $this->division?->name,
            'district_name' => $this->district?->name,
            'upazila_name' => $this->upazila?->name,
        ];
    }
}
