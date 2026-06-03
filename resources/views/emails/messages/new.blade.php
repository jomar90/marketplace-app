<x-mail::message>
    # New Message Received

    You have received a new message from **{{ $message->sender->name }}** regarding the product
    **{{ $message->product?->name ?? 'General inquiry' }}**.

    **Message:**

    {{ $message->message }}

    <x-mail::button :url="route('messages.show', $message)">
        View Message
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
