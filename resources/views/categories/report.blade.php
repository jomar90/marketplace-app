<x-layout>
    <x-slot:heading>
        Book Report (Query Builder)
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($books as $book)
            <div class="p-4 border rounded">
                <div class="font-bold">
                    {{ $book->title }}
                </div>

                <div>
                    Status:
                    @if ($book->is_borrowed)
                        <span class="text-red-500">Borrowed</span>
                    @else
                        <span class="text-green-500">Available</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
