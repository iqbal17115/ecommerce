<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ShowPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return $this->groupPermissionsByType();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
        ];
    }

    protected function groupPermissionsByType()
    {
        return $this->resource->groupBy('type')
            ->map(function ($permissionGroup) {
                return self::collection($permissionGroup);
            });
    }
}
