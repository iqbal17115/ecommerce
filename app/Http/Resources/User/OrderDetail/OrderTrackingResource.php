<?php

namespace App\Http\Resources\User\OrderDetail;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderTrackingResource extends JsonResource
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
            "id" => $this->id,
            "status" => $this->status,
            "created_at" => Carbon::parse($this->created_at)->format('d F Y h:i A'),
        ];
    }
}
