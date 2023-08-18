<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type,
            'seller_sku' => $this->seller_sku,
            'purchase_price' => $this->purchase_price,
            'opening_qty' => $this->opening_qty,
            'quantity_unit' => $this->quantity_unit,
            'your_price' => $this->your_price,
            'sale_price' => $this->sale_price,
            'retail_price' => $this->retail_price,
            'max_order_qty' => $this->max_order_qty,
            'model_number' => $this->model_number,
            'model_name' => $this->model_name,
            'sale_start_date' => $this->sale_start_date,
            'sale_end_date' => $this->sale_end_date,
            'booking_date' => $this->booking_date,
            'start_selling_date' => $this->start_selling_date,
            'offering_gift_message' => $this->offering_gift_message,
            'gift_wrap_available' => $this->gift_wrap_available,
            'brand_available' => $this->brand_available,
            'varition_type_data' => $this->varition_type_data
        ];
    }
}
