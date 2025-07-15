<?php

namespace App\Http\Resources\User\RewardPoint;

use App\Helpers\TextFormatHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRewardPointListResource extends JsonResource
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
            'type' => TextFormatHelper::formatText($this->type),
            'points' => $this->points,
            'description' => $this->description
        ];
    }
}
