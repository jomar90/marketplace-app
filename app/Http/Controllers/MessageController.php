<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->with(['sender', 'product'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create([
            ...$request->validated(),
            'sender_id' => auth()->id(),
        ]);

        Log::info('MessageSent event: Dispatching', [
            'message_id' => $message->id,
            'sender_id' => $message->sender_id,
            'receiver_id' => $message->receiver_id,
        ]);

        // Dispatch event to trigger SendMessageNotification listener
        event(new MessageSent($message));

        Log::info('MessageSent event: Dispatched successfully', [
            'message_id' => $message->id,
        ]);

        return back()->with('success', 'Message sent');
    }

    public function show(Message $message)
    {
        $this->authorize('view', $message);

        return view('messages.show', compact('message'));
    }
}
