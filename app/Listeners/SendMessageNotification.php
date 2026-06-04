<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Mail\NewMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        Log::info('SendMessageNotification: Starting to send email', [
            'message_id' => $event->message->id,
            'receiver_id' => $event->message->receiver_id,
            'receiver_email' => $event->message->receiver->email,
        ]);

        try {
            Mail::to($event->message->receiver->email)
                ->queue(new NewMessageMail($event->message));

            Log::info('SendMessageNotification: Email queued successfully', [
                'message_id' => $event->message->id,
            ]);
        } catch (\Exception $e) {
            Log::error('SendMessageNotification: Failed to queue email', [
                'message_id' => $event->message->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
