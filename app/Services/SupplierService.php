<?php

namespace App\Services;

use App\Enums\RoleEnums;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class SupplierService extends UserService
{
    /**
     * Store Or Update Supplier Process
     *
     * @param $request
     * @param null $user
     * @return User
     * @throws Exception
     */
    public function storeOrUpdateSupplierProcess($request, $user = null): User
    {
        DB::beginTransaction();
        try {
            // Get the role names based on request and user status
            $roleNames = $this->getRoleNames($request, $user);

            // Get the role IDs corresponding to the role names
            $roleIds = $this->getRoleIds($roleNames);

            // Perform user action (store or update)
            $userDetails = $this->performUserAction($request, $user);

            // Assign roles and warehouses
            foreach ($roleIds as $roleId) {
                $this->assignRolesAndWarehouses($userDetails, $request['warehouses'], $roleId);
            }

            DB::commit();

            return $userDetails;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Get Role Names
     *
     * @param $request
     * @param $user
     * @return array
     */
    protected function getRoleNames($request, $user): array
    {
        // Determine role names based on request and user status
        if ($request['both_supplier_client'] && empty($user)) {
            return [RoleEnums::SUPPLIER->value, RoleEnums::CLIENT->value];
        }

        return [RoleEnums::SUPPLIER->value];
    }
}
