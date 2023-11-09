<?php

namespace App\Http\Resources\AdminPanel\Coupon;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponDatatableResource extends JsonResource
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
            'code' => $this->code,
            'max_uses' => (int) $this->max_uses,
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'type' => $this->type,
            'value' => (float) $this->value,
            'minimum_order_amount' => (float) $this->minimum_order_amount,
            'usage_limit_per_user' => (int) $this->usage_limit_per_user,
            'is_active' => (int) $this->is_active
        ];
    }
}
