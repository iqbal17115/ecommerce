<?php

namespace App\Http\Resources\AdminPanel\RewardPointRule;

use Illuminate\Http\Resources\Json\JsonResource;

class RewardPointRuleListResource extends JsonResource
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
            'event' => $this->event,
            'points' => $this->points,
            'multiplier' => $this->multiplier,
            'status' => $this->is_active,
        ];
    }
}
