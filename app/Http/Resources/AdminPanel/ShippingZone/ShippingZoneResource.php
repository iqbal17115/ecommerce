<?php

namespace App\Http\Resources\AdminPanel\ShippingZone;

use App\Helpers\TextFormatHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingZoneResource extends JsonResource
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
            'type' => TextFormatHelper::formatText($this->type),
            'is_active' => $this->is_active,
        ];
    }
}
