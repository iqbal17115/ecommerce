<?php

namespace App\Services;

use App\Enums\LogKeyEnums;
use App\Exceptions\CustomException;
use App\Helpers\Message;
use App\Helpers\PasswordHelper;
use App\Jobs\User\NewUserConfirmationWithPasswordJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    /**
     * Store
     *
     * @param $request
     * @return User
     * @throws Exception
     */
    public function store($request): User
    {
        DB::beginTransaction();

        try {
            // Create detail resource using the data
            $user = $this->performUserAction($request);

            //Password Generate and Send Confirmation
            $password = $this->performNewPassword($user);

            //password send to user
            NewUserConfirmationWithPasswordJob::dispatch($user, $password);

            DB::commit();

            // Return a detail resource
            return $user;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Update
     *
     * @param $request
     * @param $user
     * @return User
     * @throws Exception
     */
    public function update($request, $user): User
    {
        return $this->performUserAction($request, $user);
    }

    /**
     * Perform a user action (store or update) with common logic.
     *
     * @param array $request
     * @param User|null $user
     * @return User
     * @throws Exception
     */
    protected function performUserAction(array $request, User $user = null): User
    {
        DB::beginTransaction();

        try {
            // User Create or Update
            $user = $user ?? new User();
            $user->fill(Arr::only($request, ['first_name', 'last_name', 'email', 'phone']));
            $user->save();

            // User Details update Or Create
            $user->userDetail()->updateOrCreate(
                [],
                Arr::only($request, ['country', 'state', 'zip_code', 'address'])
            );

            //Store User Roles
            if (isset($request['roles'])) {
                $this->assignRoles($user, $request['roles']);
            }

            //Store Or Update User Photo
            if (!empty($request['photo']) && !filter_var($request['photo'], FILTER_VALIDATE_URL)) {
                MediaService::createOrUpdateMedia($user, [
                    'file' => $request['photo'],
                    'type' => 'user'
                ]);
            }

            DB::commit();

            // Return a detail resource
            return $user;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * User Block
     *
     * @param $user
     * @return mixed
     * @throws CustomException
     * @throws Exception
     */
    public function block($user): mixed
    {
        if ($user->is_blocked) {
            Message::throwException(__('message.user_already_blocked'), LogKeyEnums::NO_LOG->value);
        }

        return $user->update([
            'is_blocked' => true
        ]);
    }

    /**
     * User unblock
     *
     * @param $user
     * @return mixed
     * @throws CustomException
     * @throws Exception
     */
    public function unblock($user): mixed
    {
        if (!$user->is_blocked) {
            Message::throwException(__('message.user_already_unblocked'), LogKeyEnums::NO_LOG->value);
        }

        return $user->update([
            'is_blocked' => false
        ]);
    }

    /**
     * Delete multiple users.
     *
     * @param $ids
     * @return mixed|void
     * @throws Exception
     */
    public function destroy($ids)
    {
        User::deleteModels($ids, function ($model) {
            // Delete user photos
            $model->media()->delete();

            // Detach user from all roles
            $model->roles()->detach();

            // Delete user permissions
            $model->permissions()->detach();

            // Delete user detail
            $model->userDetail()->delete();
        });

        return $ids;
    }

    /**
     * Assign Permission
     *
     * @param $user
     * @param $permissions
     * @return mixed|void
     * @throws Exception
     */
    public function assignPermissions($user, $permissions)
    {
        return $user->permissions()->sync($permissions);
    }

    /**
     * Assign Roles
     *
     * @param $user
     * @param $roles
     * @return mixed|void
     * @throws Exception
     */
    public function assignRoles($user, $roles)
    {
        return $user->roles()->sync($roles);
    }

    /**
     * Get Role Ids
     *
     * @param array $roleNames
     * @return array
     */
    protected function getRoleIds(array $roleNames): array
    {
        // Get role IDs corresponding to role names
        return Role::whereIn("name", $roleNames)->pluck("id")->toArray();
    }

    /**
     * Assign Roles and Warehouses
     *
     * @param User $user
     * @param array $warehouses
     * @param string $roleId
     * @return void
     */
    protected function assignRolesAndWarehouses(User $user, array $warehouses, string $roleId): void
    {

        // Check if the user role not exists,then attach the role
        if (!$user->roles->contains($roleId)) {
            // Attach the role
            $user->roles()->attach($roleId);
        }

        //Assign Warehouse
        $this->assignWarehouses($user, $warehouses, $roleId);
    }

    /**
     * Assign Warehouses
     *
     * @param $user
     * @param $warehouses
     * @param $roleId
     * @return void
     */
    public function assignWarehouses($user, $warehouses, $roleId): void
    {
        // Detach all existing warehouse associations
        $this->detachWarehousesByRole($user, $roleId);

        // Loop through the warehouses and roles to create the new associations
        $pivotData = [];

        foreach ($warehouses as $warehouseId) {
            $pivotData[$warehouseId] = ['role_id' => $roleId];
        }

        $user->warehouses()->attach($pivotData);
    }

    /**
     * Detach Warehouses By Role
     *
     * @param $user
     * @param $roleId
     * @return void
     */
    public function detachWarehousesByRole($user, $roleId): void
    {
        $user->warehouses()->wherePivot('role_id', $roleId)->detach();
    }

    /**
     * Delete SalesMans or Clients based on role type
     *
     * @param array $ids
     * @param string $roleType RoleEnums::SALES_MAN->value or RoleEnums::CLIENT->value or RoleEnums::SUPPLIER->value
     * @throws Exception
     */
    public function deleteUsersByRoleType(array $ids, string $roleType): void
    {
        User::deleteModels($ids, function ($model) use ($roleType) {
            // Get the role IDs corresponding to the role type
            $roleId = $this->getRoleIds([$roleType]);

            // Check if the user has other roles (excluding the current role)
            $otherRolesExist = $model->roles()->where('name', '<>', $roleType)->exists();

            // Delete the user if they have no roles left
            if (!$otherRolesExist) {
                //Delete common user attributes (photos, permissions, user detail)
                $this->deleteCommonUserAttributes($model);

                // Delete the model
                $model->delete();
            } else {
                $model->roles()->detach($roleId);
            }
        });
    }

    /**
     * Delete common user attributes (photos, permissions, user detail)
     *
     * @param User $user
     */
    protected function deleteCommonUserAttributes(User $user): void
    {
        // Delete user photos
        $user->media()->delete();

        // Detach user from all roles
        $user->roles()->detach();

        // Delete user permissions
        $user->permissions()->detach();

        // Delete user detail
        $user->userDetail()->delete();
    }

    /**
     * Perform new Password
     *
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function performNewPassword(User $user): string
    {
        //Random Password Generate and Send Mail
        $generatePassword = PasswordHelper::generatePassword();

        //Password Update
        PasswordHelper::passwordUpdate($user, $generatePassword);

        // Return a JSON response
        return $generatePassword;
    }
}
