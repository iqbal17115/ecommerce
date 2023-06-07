<?php

namespace App\Http\Controllers\FrontEnd;

use App\Enums\ReviewStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReviewController extends Controller
{
    /**
     * Get review by status
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function getReview(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        // Get products of type "product"
        $reviews = (new ReviewService())->getReviewByStatus([ReviewStatusEnum::DENY->value]);
        dd($reviews);
        // Prepare the content array with the required data
        $content = [
            "product_lists" => $products['product_lists'] ?? null
        ];
        // Return the view with the content array
        return view('frontend.product', compact('content'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'product_id' => 'required',
            'rating' => 'required'
        ]);
        // Create a new review
        $review = Review::whereUserId(Auth::user()->id)->whereProductId($validatedData['product_id'])->firstOrNew();
        $review->product_id = $validatedData['product_id'];
        $review->user_id = Auth::user()->id;
        $review->rating = $validatedData['rating'];
        $review->comment = $validatedData['comment'];
        // Save the review
        $review->save();

        // Return a JSON response
        return response()->json(['message' => 'Review submitted successfully']);
    }
}
