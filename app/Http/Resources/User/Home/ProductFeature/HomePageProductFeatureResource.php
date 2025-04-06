<?php

namespace App\Http\Resources\User\Home\ProductFeature;

use Illuminate\Http\Resources\Json\JsonResource;

class HomePageProductFeatureResource extends JsonResource
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
            'name' => $this->name,
            'products' => HomePageProductFeatureWiseProductResource::collection($this->Product->sortByDesc('created_at'))->resolve()
        ];
    }
}
