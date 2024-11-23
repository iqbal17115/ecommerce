<?php

namespace App\Http\Resources\Panel\API\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressUpdateResource extends JsonResource
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
            'name' => $this->name,
            'mobile' => $this->mobile,
            'optional_mobile' => $this->optional_mobile,
            'street_address' => $this->street_address,
            'building_name' => $this->building_name,
            'nearest_landmark' => $this->nearest_landmark,
            'instruction' => $this->instruction,
            'type' => $this->type,
            'is_default' => $this->is_default,
            'country_id' => $this->country_id,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
        ];
    }
}
