<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map(function ($permission) {
            return [
                "id" => $permission->id,
                "name" => $permission->name,
                "route" => $permission->route,
                "type" => $permission->type,
                "is_permanent" => $permission->is_permanent,
            ];
        })->all();
    }
}
