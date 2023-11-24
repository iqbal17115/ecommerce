<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\User\UserInfoResource;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    /**
     * User Info
     *
     * @param User $user
     * @return JsonResponse
     */
    public function userInfo(User $user): JsonResponse
    {
        try {
            // Return success response with the address info
            return Message::success(null, new UserInfoResource($user));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
