<?php

namespace App\Http\Resources\Panel\API\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressListResource extends JsonResource
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
            'type' => $this->type,
            'is_default' => $this->is_default,
            'country' => $this->country?->name,
            'division' => $this->division?->name,
            'district' => $this->district?->name,
        ];
    }
}
