<?php

namespace App\Listeners;

use App\Events\BidCreated;
use App\Mail\BidNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendBidNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BidCreated $event): void
    {
        Mail::to($event->bid->product->user->email)
            ->send(new BidNotificationMail($event->bid));
    }
}
