<x-layout>
    <x-slot:heading>
        Messages
    </x-slot:heading>

    <div class="space-y-4">

        @forelse ($messages as $message)
            <a href="{{ route('messages.show', $message) }}" class="block p-4 border rounded hover:bg-gray-50">

                <div class="font-bold text-sm text-gray-800">
                    From: {{ $message->sender->name }}
                </div>

                <div class="text-sm text-gray-600">
                    Product: {{ $message->product->name }}
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    {{ Str::limit($message->content, 80) }}
                </div>

            </a>
        @empty
            <p class="text-gray-500">No messages found.</p>
        @endforelse

    </div>
</x-layout>
