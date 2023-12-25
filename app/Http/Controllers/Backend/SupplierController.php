<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierService;
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Index
     *
     * @param SupplierListRequest $request
     * @return JsonResponse
     */
    public function index(SupplierListRequest $request): JsonResponse
    {
        try {
            // Call the Service to get list data
            $lists = User::getLists(User::withRole([RoleEnums::SUPPLIER->value]), $request->validated(), SupplierListResource::class);

            // Return a success message with the data
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/index');
        }
    }

    /**
     * Select Lists
     *
     * @param SelectListRequest $request
     * @return JsonResponse
     */
    public function selectLists(SelectListRequest $request): JsonResponse
    {
        try {
            // Get the lists
            $lists = User::getAllLists(User::withRole([RoleEnums::SUPPLIER->value]), $request->validated(), SelectListResource::class);

            // Return success response with the lists
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/selectLists');
        }
    }

    /**
     * Show
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        try {
            // get Details and convert to resource
            $user = SupplierDetailResource::make($user);

            // Return a success response with the data
            return Message::success(null, $user);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/show');
        }
    }

    /**
     * Store
     *
     * @param SupplierRequest $request
     * @return JsonResponse
     */
    public function store(SupplierRequest $request): JsonResponse
    {
        try {
            // Validate the request data and store the data
            $user = $this->supplierService->storeOrUpdateSupplierProcess($request->validated());

            // Return a success message with the stored data
            return Message::success(__("message.save"), SupplierDetailResource::make($user));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/store');
        }
    }

    /**
     * Update
     *
     * @param SupplierRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(SupplierRequest $request, User $user): JsonResponse
    {
        try {
            // Validate the request data and update the data
            $user = $this->supplierService->storeOrUpdateSupplierProcess($request->validated(), $user);

            // Return a success message with the updated data
            return Message::success(__("message.update"), SupplierDetailResource::make($user));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/update');
        }
    }

    /**
     * Destroy
     *
     * @param MultipleDeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(MultipleDeleteRequest $request): JsonResponse
    {
        try {
            //Delete Suppliers
            $this->supplierService->deleteUsersByRoleType($request->ids, RoleEnums::SUPPLIER->value);

            // Return a success message
            return Message::success(__("message.delete"), $request->ids);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SupplierController/destroy');
        }
    }
}
