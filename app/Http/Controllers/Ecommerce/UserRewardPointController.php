<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RewardPoint\UserRewardPointListRequest;
use App\Http\Resources\User\RewardPoint\UserRewardPointListResource;
use App\Http\Resources\User\UserRewardPointResource;
use App\Models\RewardPointTransaction;
use Exception;
use Illuminate\Http\Request;

class UserRewardPointController extends Controller
{
    public function userRewardPoint()
    {
        try {
            $user = auth()->user();
            // Return a success message with the data
            return Message::success(null, UserRewardPointResource::make($user));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    public function summary(UserRewardPointListRequest $request)
    {
        // Call the Service to get list data
        $lists = RewardPointTransaction::getLists(RewardPointTransaction::query(), $request->validated(), UserRewardPointListResource::class);

        // Return a success message with the data
        return Message::success(null, $lists);
    }
}
