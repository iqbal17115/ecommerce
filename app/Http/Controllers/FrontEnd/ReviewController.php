<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
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
