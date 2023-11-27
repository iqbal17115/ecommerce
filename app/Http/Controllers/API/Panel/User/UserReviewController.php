<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Review\UserReviewRequest;
use App\Http\Resources\User\Review\UserReviewResource;
use App\Models\FrontEnd\Review;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReviewController extends Controller
{
    use BaseModel;

    /**
     * Country lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            $list = $this->getAllLists(Review::where('user_id', $request->user_id)->where('product_id', $request->product_id), $request->all(), UserReviewResource::class);
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Country lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function allReviews(Request $request): JsonResponse|bool|string
    {
        try {
            $list = $this->getAllLists(Review::where('user_id', $request->user_id), $request->all(), UserReviewResource::class);
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Review
     *
     * @param UserReviewRequest $userReviewRequest
     * @return JsonResponse
     */
    public function store(UserReviewRequest $userReviewRequest): JsonResponse
    {
        try {
            // Review save
            Review::create($userReviewRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
