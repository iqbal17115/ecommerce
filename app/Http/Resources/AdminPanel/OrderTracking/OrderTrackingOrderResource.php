<?php

namespace App\Http\Resources\AdminPanel\OrderTracking;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderTrackingOrderResource extends JsonResource
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
            'order_date' => $this->order_date,
            'status' => $this->status,
            'tracking_details' => OrderTrackingDetailResource::collection($this->orderTracking),
        ];
    }
}
