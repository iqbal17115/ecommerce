<?php

namespace App\Http\Resources\AdminPanel\AddProductCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class AddProductCategoryResource extends JsonResource
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
            'name'      => $this->name,
            'full_path' => $this->getFullPath(),
            'children'  => AddProductCategoryResource::collection($this->whenLoaded('childrenRecursive')),
        ];
    }

    /**
     * Build full category path (like "Electronics > Cameras > Digital Cameras")
     */
    private function getFullPath()
    {
        $path = [];
        $current = $this;

        while ($current) {
            array_unshift($path, $current->name);
            $current = $current->parent;
        }

        return implode(' > ', $path);
    }
}
