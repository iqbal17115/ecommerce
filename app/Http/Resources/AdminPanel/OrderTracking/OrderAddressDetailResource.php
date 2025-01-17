<?php

namespace App\Http\Resources\AdminPanel\OrderTracking;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderAddressDetailResource extends JsonResource
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
            'address' => $this->division_name.', '.$this->district_name.', '.$this->upazila_name.', '.$this->street_address
        ];
    }
}
