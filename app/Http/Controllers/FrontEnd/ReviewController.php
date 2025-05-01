<?php

namespace App\Http\Controllers\FrontEnd;

use App\Enums\ReviewStatusEnum;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Review\StoreUserReviewRequest;
use App\Http\Resources\User\Review\UserReviewListResource;
use App\Models\Backend\Product\Product;
use App\Models\FrontEnd\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    // Get reviews for a specific product
    public function index(Product $product): JsonResponse
    {
        $reviews = $product->reviews()->latest()->get();

        return Message::success(null, UserReviewListResource::collection($reviews));
    }

    // Store a review
    public function store(StoreUserReviewRequest $request): JsonResponse
    {
        $data = $request->validated();

        $review = Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $data['product_id'],
            'rating'     => $data['rating'],
            'comment'    => $data['comment'],
            'status'     => 'pending',
        ]);

        return Message::success(null, UserReviewListResource::make($review));
    }
}
