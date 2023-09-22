<?php

namespace App\Helpers;

use App\Enums\LogKeyEnums;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class AuthHelper
{
    /**
     * Create Personal Access Token
     *
     * @param User $user
     * @param string $name
     * @return string
     */
    public static function createPersonalAccessToken(User $user, string $name): string
    {
        return $user->createToken($name)->plainTextToken;
    }

    /**
     * Is Authenticated
     *
     * @return bool
     */
    public static function isAuthenticated(): bool
    {
        return auth()->guard('sanctum')->check();
    }

    /**
     * Is Valid User
     *
     * @param $user
     * @return Authenticatable|null
     * @throws Exception
     */
    public static function isValidUser($user): ?Authenticatable
    {
        // check if user is valid
        if (is_null($user)) {
            Message::throwException(__('message.something_wrong_here'));
        }

        return $user;
    }

    /**
     * Is Verified User
     *
     * @param $user
     * @return Authenticatable|null
     * @throws Exception
     */
    public static function isVerifiedUser($user): ?Authenticatable
    {
        // check if user is valid
        if (!is_null($user) && $user->hasVerifiedEmail()) {
            Message::throwException(
                __('message.user_already_verified'),
                LogKeyEnums::NO_LOG
            );
        }

        return $user;
    }

    /**
     * Is Not Verified User
     *
     * @param $user
     * @return Authenticatable|null
     * @throws Exception
     */
    public static function isNotVerifiedUser($user): ?Authenticatable
    {
        // check if user is valid
        if (!is_null($user) && !$user->hasVerifiedEmail()) {
            Message::throwException("User Not Verified");
        }

        return $user;
    }

    /**
     * Get Authenticated User
     *
     * @return Authenticatable|null
     */
    public static function getAuthenticatedUser(): ?User
    {
        return auth()->guard('sanctum')->user();
    }

    /**
     * Get User Roles Permissions
     *
     * @param null $user
     * @return array|null
     */
    public static function getUserRolesPermissions($user, $roleId): ?array
    {
        try {
            $roleDetails = null;

            // Iterate over user roles
            foreach ($user->roles as $role) {
                // Filter roles by roleIds if provided
                if (!empty($roleId) && ($role->id === $roleId)) {
                    $roleDetails = $role;
                }
            }

            // Group Permissions By Type
            $permissionsByType = self::groupPermissionsByType($roleDetails?->permissions);

            // Merge permissions with system routes
            $permissions = self::mergePermissionsWithSystemRoutes($permissionsByType, config("contents.system_permissions"));

            return [
                'name' => $roleDetails?->name,
                'is_admin' => $roleDetails?->is_admin,
                'permissions' => self::mergePermissionsJsonDecodes($permissions),
            ];
        } catch (Exception $ex) {
            // Return an empty array or a default value depending on your application requirements
            return null;
        }
    }

    /**
     * Group Permissions By Type
     *
     * @param $permissions
     * @return array
     */
    public static function groupPermissionsByType($permissions): array
    {
        return collect($permissions)
            // Group permissions by type
            ->groupBy('type')
            // Extract only the route values
            ->map(fn($permissions) => $permissions->pluck('route')->all())
            ->all();
    }

    /**
     * Merge Permissions With System Routes
     *
     * @param $permissions
     * @param $systemRoutes
     * @return array
     */
    public static function mergePermissionsWithSystemRoutes($permissions, $systemRoutes): array
    {
        $mergedArray = [];

        // Merge permissions with system routes by type
        foreach ($permissions as $type => $permissionRoutes) {
            // If system routes exist for the type, merge them with permission routes
            if (isset($systemRoutes[$type])) {
                $mergedArray = array_merge($mergedArray, $permissionRoutes, $systemRoutes[$type]);
            } else {
                // If no system routes exist, only merge permission routes
                $mergedArray = array_merge($mergedArray, $permissionRoutes);
            }
        }

        return array_unique($mergedArray);
    }

    /**
     * Merge PermissionsJson Decodes
     *
     * @param $permissions
     * @return array
     */
    public static function mergePermissionsJsonDecodes($permissions): array
    {
        $filteredPermissions = [];

        // Merge JSON decodes and filter permissions
        foreach ($permissions as $permission) {
            // Attempt to decode the permission as JSON
            $routes = json_decode($permission, true);

            // If decoding fails, assume it as a single route
            if ($routes === null) {
                $routes = [$permission];
            }

            $filteredPermissions = array_merge($filteredPermissions, $routes);
        }

        return $filteredPermissions;
    }
}
