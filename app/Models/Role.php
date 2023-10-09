<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'details',
        'is_permanent',
        'is_admin',
        'is_registered',
        'created_by',
        'updated_by'
    ];

    protected $searchable = [
        'name',
        'details',
    ];

    protected $sortable = [
        'name',
        'details',
    ];

    /**
     * Define the many-to-many relationship with permissions.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id');
    }

    /**
     * Define the many-to-many relationship with users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "users_roles", "role_id", "user_id")
            ->withTimestamps()
            ->as('role_user');
    }

    /**
     * Delete Role Permissions
     *
     * @param $ids
     * @return int
     */
    public static function deleteRolePermissions($ids): int
    {
        return DB::table('role_permissions')
            ->whereIn('role_id', $ids)
            ->delete();
    }
}
