<?php

namespace App\Http\Resources\User\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderAddressResource extends JsonResource
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
            "name" => $this->name,
            "instruction" => $this->instruction,
            "mobile" => $this->mobile,
            "optional_mobile" => $this->optional_mobile,
            "street_address" => $this->street_address,
            "building_name" => $this->building_name,
            "nearest_landmark" => $this->nearest_landmark,
            "type" => $this->type,
            "country_name" => $this->country_name,
            "division_name" => $this->division_name,
            "district_name" => $this->district_name,
            "upazila_name" => $this->upazila_name,
        ];
    }
}
