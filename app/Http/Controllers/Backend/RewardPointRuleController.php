<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\RewardPointRule\RewardPointRuleCreateRequest;
use App\Http\Requests\AdminPanel\RewardPointRule\RewardPointRuleListRequest;
use App\Http\Requests\AdminPanel\RewardPointRule\RewardPointRuleUpdateRequest;
use App\Http\Resources\AdminPanel\RewardPointRule\RewardPointRuleListResource;
use App\Http\Resources\AdminPanel\RewardPointRuleView\RewardPointRuleViewResource;
use App\Models\RewardPointRule;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;

class RewardPointRuleController extends Controller
{
    use BaseModel;

    /**
     * index
     *
     * @param RewardPointRuleListRequest $request
     * @return JsonResponse
     */
    public function index(RewardPointRuleListRequest $request): bool|string
    {
        // Call the Service to get list data
        return $this->dataTable(RewardPointRule::query(), $request->all(), RewardPointRuleListResource::class);
    }

    /**
     * Show
     *
     * @param RewardPointRule $rewardPointRule
     * @return JsonResponse
     */
    public function show(RewardPointRule $rewardPointRule): JsonResponse
    {
        // get Details and convert to resource
        $rewardPointRule = RewardPointRuleViewResource::make($rewardPointRule);

        // Return a success response with the data
        return Message::success(null, $rewardPointRule);
    }

    /**
     * Store
     *
     * @param RewardPointRuleCreateRequest $request
     * @return JsonResponse
     */
    public function store(RewardPointRuleCreateRequest $request): JsonResponse
    {
        // Validate the request data and store the data
        $rewardPointRule = RewardPointRule::create($request->validated());

        // Return a success message with the stored data
        return Message::success(__("message.save"), RewardPointRuleViewResource::make($rewardPointRule));
    }

    /**
     * Update
     *
     * @param RewardPointRuleUpdateRequest $request
     * @param RewardPointRule $rewardPointRule
     * @return JsonResponse
     */
    public function update(RewardPointRuleUpdateRequest $request, RewardPointRule $rewardPointRule): JsonResponse
    {
        // Validate the request data and update the data
        $rewardPointRule->update($request->validated());

        // Return a success message with the updated data
        return Message::success(__("message.update"), RewardPointRuleViewResource::make($rewardPointRule));
    }

    /**
     * Update Status
     *
     * @param $categoryId
     * @return JsonResponse
     */
    public function updateStatus($categoryId): JsonResponse
    {
        $category            = RewardPointRule::find($categoryId);
        $category->is_active = ! $category->is_active;
        $category->save();

        // Return a success response with the data
        return Message::success(__("message.update"));
    }

    /**
     * Destroy
     *
     * @param RewardPointRule $rewardPointRule
     * @return JsonResponse
     */
    public function destroy(RewardPointRule $rewardPointRule): JsonResponse
    {
        // Delete the data
        $rewardPointRule->delete();
        // Return a success message
        return Message::success(__("message.delete"));
    }
}
