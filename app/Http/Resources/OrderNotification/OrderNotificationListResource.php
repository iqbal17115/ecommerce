<?php

namespace App\Http\Resources\OrderNotification;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderNotificationListResource extends JsonResource
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
            'name' => $this->user->name,
            'mobile' => $this->user->mobile,
            'code' => $this->code,
            'order_date' => Carbon::parse($this->order_date)->diffForHumans(),
            'profile_photo' => url(config("contents.default_user_photo")),

        ];
    }
}
