<?php

namespace App\Http\Resources\AdminPanel\ShopSetting;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSettingUpazilaUpdateResource extends JsonResource
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
            'district_id' => $this->District->id,
            'district_name' => $this->District->name,
            'status' => $this->status,
        ];
    }
}
