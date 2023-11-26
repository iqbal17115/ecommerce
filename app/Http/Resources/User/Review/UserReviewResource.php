<?php

namespace App\Http\Resources\User\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReviewResource extends JsonResource
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
            "user_name" => $this->user->name,
            "product_name" => $this->product?->name,
            "rating" => $this->rating,
            "comment" => $this->comment,
            "profile_photo" => $this->user?->profile_photo ? url('storage/'.$this?->profile_photo) : url(config("contents.default_user_photo")),
            "created_at" => $this->created_at->diffForHumans(),
        ];
    }
}
