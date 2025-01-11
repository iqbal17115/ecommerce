<?php

namespace App\Http\Resources\AdminPanel\OrderTracking;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderTrackingDetailResource extends JsonResource
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
            'status' => ucfirst($this->status),
            'created_at' => $this->created_at
        ];
    }
}
