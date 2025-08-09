<?php

namespace App\Http\Resources\AdminPanel\ShippingCharge;

use App\Helpers\NumberHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingChargeResource extends JsonResource
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
            'division_id' => $this->division_id,
            'division_name' => $this->division ? $this->division->name : null,
            'district_id' => $this->district_id,
            'district_name' => $this->district ? $this->district->name : null,
            'upazila_id' => $this->upazila_id,
            'upazila_name' => $this->upazila ? $this->upazila->name : null,
            'min_order_amount' => NumberHelper::convertToInteger($this->min_order_amount),
            'max_order_amount' => NumberHelper::convertToInteger($this->max_order_amount),
            'min_weight' => NumberHelper::convertToInteger($this->min_weight),
            'max_weight' => NumberHelper::convertToInteger($this->max_weight),
            'min_qty' => NumberHelper::convertToInteger($this->min_qty),
            'max_qty' => NumberHelper::convertToInteger($this->max_qty),
            'charge_amount' => NumberHelper::convertToInteger($this->charge_amount),
            'is_active' => (bool) $this->is_active,
        ];
    }
}
