<x-layout>
    <x-slot:heading>
        {{ __('books.title') }}
    </x-slot:heading>

    @auth
    <a href="{{ route('books.report') }}">Book Report</a>
@endauth

        <a href="/lang/en">En</a> |
        <a href="/lang/nl">NL</a>

    <form class="flex items-center gap-2 mb-6">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search books..."
                class="w-72 pl-3 pr-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <x-form-button>
            Search
        </x-form-button>
    </form>

    <div class="space-y-4">
        @foreach ($books as $book)
            <div class="px-4 py-6 border border-gray-200 rounded-lg">

                <!-- Publisher -->
                <div class="font-bold text-blue-500 text-sm">
                    <a href="/publishers/{{ $book->publisher?->id }}">
                        {{ $book->publisher?->name }}
                    </a>
                </div>

                <div>
                    <strong>
                        <a href="/books/{{ $book->id }}" class="text-blue-600">
                            {{ $book->title }}
                        </a>
                    </strong>
                    : written by {{ $book->author }}.
                </div>

                {{-- @php
                    $isBorrowed = $book->borrowings->whereNull('return_date')->count();
                @endphp --}}

            <div class="mt-3">
                @if ($book->isBorrowed())
                    <span class="text-red-500 font-semibold">
                        {{ $book->statusLabel() }}
                    </span>

                    <form action="/books/{{ $book->id }}/return" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="ml-3 text-sm text-blue-600">
                            {{ __('books.return') }}
                        </button>
                    </form>
                @else
                    <span class="text-green-500 font-semibold">
                        {{ $book->statusLabel() }}
                    </span>

                    <form action="/books/{{ $book->id }}/borrow" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="ml-3 text-sm text-blue-600">
                            {{ __('books.borrow') }}
                        </button>
                    </form>
                @endif
            </div>
            </div>
        @endforeach
        <div>
            {{ $books->links() }}
        </div>
    </div>
</x-layout>
