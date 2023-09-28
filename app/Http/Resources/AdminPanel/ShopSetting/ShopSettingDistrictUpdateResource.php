<?php

namespace App\Http\Resources\AdminPanel\ShopSetting;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSettingDistrictUpdateResource extends JsonResource
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
            'division_id' => $this->Division->id,
            'division_name' => $this->Division->name,
            'status' => $this->status,
        ];
    }
}
