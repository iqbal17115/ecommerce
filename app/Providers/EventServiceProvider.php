<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Events\ProductReviewed;
use App\Events\UserRegistered;
use App\Listeners\EarnPointsForOrder;
use App\Listeners\EarnPointsForRegistration;
use App\Listeners\EarnPointsForReview;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            EarnPointsForRegistration::class,
        ],
        OrderPlaced::class => [
            EarnPointsForOrder::class,
        ],
        ProductReviewed::class => [
            EarnPointsForReview::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
