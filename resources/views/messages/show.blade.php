<x-layout>
    <x-slot:heading>
        Message
    </x-slot:heading>

    <div class="border rounded p-4 space-y-4">

        <div>
            <div class="text-sm text-gray-500">From</div>
            <div class="font-bold">{{ $message->sender->name }}</div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Product</div>
            <div>{{ $message->product->name }}</div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Message</div>
            <div class="mt-2 whitespace-pre-line">
                {{ $message->content }}
            </div>
        </div>

    </div>

    {{-- Reply form (optional but useful) --}}
    <form method="POST" action="{{ route('messages.store') }}" class="mt-6 space-y-2">
        @csrf

        <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
        <input type="hidden" name="product_id" value="{{ $message->product_id }}">

        <textarea name="content" rows="4" class="w-full border rounded p-2" placeholder="Write a reply..." required></textarea>

        <x-form-button>
            Send Reply
        </x-form-button>
    </form>
</x-layout>
