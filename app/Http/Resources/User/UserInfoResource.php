<?php

namespace App\Http\Resources\User;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
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
            "name" => Str::limit($this->name, 10, '...'),
            'profile_photo' => $this?->profile_photo_path ? url('storage/'.$this?->profile_photo_path) : url(config("contents.default_user_photo"))
        ];
    }
}
