<?php

namespace App\Http\Resources\User\MyAccount\MyAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class MyReviewResource extends JsonResource
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
            "user_name" => $this->user->name,
            "product_name" => $this->product->name,
            "rating" => $this->rating,
            "comment" => $this->comment,
        ];
    }
}
