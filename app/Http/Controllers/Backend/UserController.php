<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserDatatableResource;
use App\Http\Resources\User\UserUpdateResource;
use App\Models\User;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use BaseModel;

    /**
     * User Lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            return $this->dataTable(User::query(), $request->all(), UserDatatableResource::class);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * User Info
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        try {
            // Return success response with the user info
            return Message::success(null, new UserUpdateResource($user));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store User
     *
     * @param UserCreateRequest $userCreateRequest
     * @return JsonResponse
     */
    public function store(UserCreateRequest $userCreateRequest): JsonResponse
    {
        try {
            // User save
            $user = User::create($userCreateRequest->validated());

            $user->roles()->sync($userCreateRequest['role_id']);

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update User
     *
     * @param UserUpdateRequest $userUpdateRequest
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user): JsonResponse
    {
        try {
            // Update user
            $user->update($userUpdateRequest->validated());

            $user->roles()->sync($userUpdateRequest['role_id']);

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * User Delete
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Call the function delete user
            $user->roles()->delete();
            $user->delete();

            DB::commit();
            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            DB::rollBack();
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
