<?php

namespace App\Http\Resources\AdminPanel\RewardPointRuleView;

use Illuminate\Http\Resources\Json\JsonResource;

class RewardPointRuleViewResource extends JsonResource
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
            'multiplier' => $this->multiplier
        ];
    }
}
