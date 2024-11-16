<?php

namespace App\Http\Resources\AdminPanel\ShopSetting;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSettingAddressInstructionResource extends JsonResource
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
            'property_type' => $this->property_type,
            'closed_day_for_delivery' => $this->closed_day_for_delivery,
            'package_leave_address' => $this->package_leave_address,
            'description' => $this->description
        ];
    }
}
