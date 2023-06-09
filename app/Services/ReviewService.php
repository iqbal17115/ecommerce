<?php

namespace App\Services;

use App\Models\FrontEnd\Review;
use Illuminate\Database\Eloquent\Collection;

class ReviewService
{
    public function changeStatus($reviewId, $status)
    {
        // Find the review by ID
        $review = Review::findOrFail($reviewId);
        $review->status = $status;
        $review->save();
    }
    /**
     * Get Review By Status
     *
     * @param $status
     * @return array
     */
    public function getReviewByStatus($status = null, $limit = null, $pagination = true): \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|array
    {
        $query = Review::select("reviews.*")
            ->when($status !== null, function ($query) use ($status) {
                return $query->whereIn("status", $status);
            })
            ->latest('created_at');

        if ($pagination) {
            return $query->paginate($limit)->groupBy('status');
        }

        return $query->get()->groupBy('status');
    }
}
