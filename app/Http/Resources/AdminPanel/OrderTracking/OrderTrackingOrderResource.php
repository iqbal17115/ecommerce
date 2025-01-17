<?php

namespace App\Http\Resources\AdminPanel\OrderTracking;

use Carbon\Carbon;
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
            'order_date' => Carbon::parse($this->order_date)->format('d F Y'),
            'status' => $this->status,
            'user' => UserDetailsResource::make($this->user),
            'order_address' => OrderAddressDetailResource::make($this->orderAddress),
            'tracking_details' => OrderTrackingDetailResource::collection($this->orderTracking),
        ];
    }
}
