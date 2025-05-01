<?php

namespace App\Http\Resources\User\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReviewListResource extends JsonResource
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
            'id'        => $this->id,
            'user_name' => optional($this->user)->name,
            'rating'    => $this->rating,
            'comment'   => $this->comment,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
