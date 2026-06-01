<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Mail\NewMessageMail;
use Illuminate\Support\Facades\Mail;

class SendMessageNotification
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
    public function handle(MessageSent $event): void
    {
        Mail::to($event->message->receiver->email)
            ->queue(new NewMessageMail($event->message));
    }
}
