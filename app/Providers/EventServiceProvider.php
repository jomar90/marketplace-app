<?php

namespace App\Providers;

use App\Events\BidCreated;
use App\Events\MessageSent;
use App\Events\ProductCreated;
use App\Listeners\SendBidNotification;
use App\Listeners\SendMessageNotification;
use App\Listeners\SendProductCreatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MessageSent::class => [
            SendMessageNotification::class,
        ],
        ProductCreated::class => [
            SendProductCreatedNotification::class,
        ],
        BidCreated::class => [
            SendBidNotification::class,
        ],
    ];

    /**
     * Enable the scanning of events and listeners found within the app path.
     */
}
