<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Services\RewardPointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EarnPointsForRegistration
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        app(RewardPointService::class)->awardPoints(
            event: 1,
            user: $event->user,
            context: []
        );
    }
}
