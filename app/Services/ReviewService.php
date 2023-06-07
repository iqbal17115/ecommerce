<?php

namespace App\Services;

use App\Models\FrontEnd\Review;

class ReviewService
{
    /**
     * Get Review By Status
     *
     * @param $status
     * @return array
     */
    public function getReviewByStatus($status = null): array
    {
        // Prepare the query to retrieve review
        $query = Review::query();

        $query->when($status !== null, function ($query) use ($status) {
            return $query->whereIn("status", $status);
        });

        // Retrieve the review
        $reviews = $query->get();

        // Prepare the content array with the required data dynamically
        $content = [];

        foreach ($reviews as $review) {
            $content[$review->status . '_lists'][] = $review;
        }

        return $content;
    }
}
