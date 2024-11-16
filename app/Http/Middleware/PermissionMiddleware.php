<?php

namespace App\Http\Middleware;

use App\Helpers\AuthHelper;
use App\Helpers\Message;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the name of the current route
        $routeName = $request->route()->getName();

        // Get the authenticated user
        $user = AuthHelper::getAuthenticatedUser();

        // Check if the user has any roles assigned
        if (!$this->userHasRoles($user)) {
            $this->handleUnauthorizedRequest($request);
        }

        // If the user has only one role, and it's an admin, grant access immediately
        if ($this->userIsAdmin($user)) {
            return $next($request);
        }

        // Retrieve the role ID from the request header (or a default value)
        $roleId = Session::get('selected_role_id_'.auth()->user()->id) ?? $user->roles->first()?->id;

        if(is_object($roleId)){
            $roleId = $roleId->id;
        }

        // Get the user's permissions for the specified role ID
        $rolePermission = AuthHelper::getUserRolesPermissions($user, $roleId);

        if(empty($rolePermission['permissions']) && !$rolePermission['is_admin']){
            $this->handleUnauthorizedRequest($request);
        }

        // Grant access if the user has admin permissions for the role
        if ($this->userIsAdminWithRolePermissions($rolePermission)) {
            return $next($request);
        }

        // Check if the user's role permissions are empty
        if (empty($rolePermission['permissions'])) {
            $this->handleUnauthorizedRequest($request);
        }

        // Check if the current route is allowed based on user permissions
        if (!$this->userHasPermissionForRoute($routeName, $rolePermission['permissions'])) {
            $this->handleUnauthorizedRequest($request);
        }

        // If all checks pass, continue processing the request
        return $next($request);
    }

    /**
     * Check if the user has roles assigned.
     *
     * @param mixed $user
     * @return bool
     */
    protected function userHasRoles(mixed $user): bool
    {
        return !empty($user->roles);
    }

    /**
     * Check if the user has a single admin role.
     *
     * @param mixed $user
     * @return bool
     */
    protected function userIsAdmin(mixed $user): bool
    {
        return $user->roles->count() == 1 && $user->roles->first()?->is_admin;
    }

    /**
     * Check if the user has admin permissions for the role.
     *
     * @param array $rolePermission
     * @return bool
     */
    protected function userIsAdminWithRolePermissions(array $rolePermission): bool
    {
        return $rolePermission['is_admin'];
    }

    /**
     * Check if the user has permission for the current route.
     *
     * @param string $routeName
     * @param array $permissions
     * @return bool
     */
    protected function userHasPermissionForRoute(string $routeName, array $permissions): bool
    {
        return in_array($routeName, $permissions);
    }

    /**
     * Handle an unauthorized request.
     *
     * @param Request $request
     * @throws Exception
     */
    protected function handleUnauthorizedRequest($request): void
    {
        if ($request->ajax()) {
            // Handle AJAX request with an unauthorized exception
            Message::throwException("Access Denied", Response::HTTP_UNAUTHORIZED);
        }
        // Handle non-AJAX request with an unauthorized response
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
