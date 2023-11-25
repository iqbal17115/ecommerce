<?php

namespace App\Http\Controllers\API\Panel\User\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\MyAccount\MyAccount\MyReviewResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyReviewController extends Controller
{
    /**
     * User Info
     *
     * @param User $user
     * @return JsonResponse
     */
    public function userReview(User $user): JsonResponse
    {
        try {
            // Return success response with the address info
            return Message::success(null, MyReviewResource::collection($user->reviews));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
