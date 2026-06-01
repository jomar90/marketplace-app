<?php

namespace App\Listeners;

use App\Mail\ProductCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendProductCreatedNotification implements ShouldQueue
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
    public function handle(object $event): void
    {
        Mail::to($event->product->user->email)
            ->queue(new ProductCreatedMail($event->product));
    }
}
