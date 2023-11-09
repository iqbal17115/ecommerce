<?php

namespace App\Http\Resources\AdminPanel\CouponProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponProductResource extends JsonResource
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
            'products' => CouponCouponProductResource::make($this->product)
        ];
    }
}
