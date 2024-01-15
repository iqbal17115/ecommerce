<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleDatatableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "details" => $this->details,
            "is_permanent" => $this->is_permanent,
            "is_admin" => $this->is_admin,
            "is_registered" => $this->is_registered,
            "created_at" => $this->created_at->format('Y-m-d')
        ];
    }
}
