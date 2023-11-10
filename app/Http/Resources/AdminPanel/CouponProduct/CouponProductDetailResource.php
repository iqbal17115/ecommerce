<?php

namespace App\Http\Resources\AdminPanel\CouponProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponProductDetailResource extends JsonResource
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
            'products' => CouponProductResource::collection($this->coupon_products)
        ];
    }
}
