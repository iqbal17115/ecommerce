<?php

namespace App\Http\Controllers\Backend;

use App\Enums\RoleTypeEnum;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\AssignRoleRequest;
use App\Http\Requests\Setting\RoleCreateRequest;
use App\Http\Requests\Setting\RoleUpdateRequest;
use App\Http\Resources\Role\RoleDatatableResource;
use App\Http\Resources\Role\ShowPermissionResource;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RoleController extends Controller
{
    use BaseModel;

    /**
     * Role lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            return $this->dataTable(Role::query()->where('type', RoleTypeEnum::GLOBAL), $request->all(), RoleDatatableResource::class);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Role Info
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        try {
            // Return success response with the role info
            return Message::success(null, new RoleDatatableResource($role));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Role
     *
     * @param RoleCreateRequest $roleCreateRequest
     * @return JsonResponse
     */
    public function store(RoleCreateRequest $roleCreateRequest): JsonResponse
    {
        try {
            // Role save
            Role::create($roleCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Role
     *
     * @param RoleUpdateRequest $roleUpdateRequest
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role): JsonResponse
    {
        try {
            $role->update($roleUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Role Delete
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            // Call the function delete role
            $role->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Role Info
     *
     * @return JsonResponse
     */
    public function permissions(): JsonResponse
    {
        try {
            $permissions = Permission::where('role_type', 'global')->get();

            // Return success response with the role info
            return Message::success(null, new ShowPermissionResource($permissions));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * GET Role Permission Info
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function getRolePermissions(Role $role): JsonResponse
    {
        try {
            $rolesPermissions = DB::table('roles_permissions')
                ->where('role_id', $role->id)
                ->get();

            // Return success response with the role info
            return Message::success(null, $rolesPermissions);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Assign Role Request
     *
     * @param AssignRoleRequest $assignRoleRequest
     * @return JsonResponse
     */
    public function storeAssignPermission(AssignRoleRequest $assignRoleRequest, Role $role): JsonResponse
    {
        try {
            $role->permissions()->sync($assignRoleRequest->permissions);

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Set Selected Role
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setSelectedRole(Request $request): JsonResponse
    {
        try {
            // Get the lists
            $selectedRoleId = $request->input('selected_role_id');
            Session::put('selected_role_id_' . auth()->user()->id, $selectedRoleId);

            // Return success response with the lists
            return Message::success(__("messages.success_add"));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    public function index(): View
    {
        return view('backend.role.index');
    }
}
