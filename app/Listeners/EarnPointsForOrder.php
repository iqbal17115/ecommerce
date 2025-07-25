<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Services\RewardPointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EarnPointsForOrder
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        app(RewardPointService::class)->awardPoints(
            event: 2,
            user: $event->order->user,
            context: ['amount' => $event->order->total_amount]
        );
    }
}
