<?php

namespace App\Listeners;

use App\Events\ProductReviewed;
use App\Services\RewardPointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EarnPointsForReview
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductReviewed  $event
     * @return void
     */
    public function handle(ProductReviewed $event)
    {
        app(RewardPointService::class)->awardPoints(
            event: 3, // 3 = Review
            user: $event->review->user,
            context: ['product_id' => $event->review->product_id]
        );
    }
}
