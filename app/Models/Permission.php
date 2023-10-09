<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $table = 'permissions';

    protected $fillable = [
        'id',
        'name',
        'route',
        'details',
        'type',
        'feature',
        'is_permanent'
    ];

    protected $searchable = [
        'name',
        'route',
        'details',
        'type'
    ];

    protected $sortable = [
        'name',
        'route',
        'details',
        'type'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'permission_id', 'role_id');
    }

    protected function displayName(): Attribute
    {
        return new Attribute(function () {
            return $this->type . "(" . $this->name . ")";
        });
    }
}
