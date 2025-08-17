<?php

namespace App\Http\Resources\AdminPanel\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'shipping_zone_id' => $this->shipping_zone_id,
            'min_weight'       => $this->min_weight,
            'max_weight'       => $this->max_weight,
            'min_amount'       => $this->min_amount,
            'max_amount'       => $this->max_amount,
            'min_qty'          => $this->min_qty,
            'max_qty'          => $this->max_qty,
            'rate'             => $this->rate,
            'is_active'        => (bool) $this->is_active
        ];
    }
}
