<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;

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

        event(new MessageSent($message));

        return back()->with('success', 'Message sent');
    }

    public function show(Message $message)
    {
        $this->authorize('view', $message);

        return view('messages.show', compact('message'));
    }
}
