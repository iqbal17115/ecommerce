<?php

namespace App\Http\Resources\AdminPanel\ShopSetting;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSettingUpazilaListResource extends JsonResource
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
            'district_id' => $this->district_id,
            'name' => $this->name,
            'status' => $this->status
        ];
    }
}
