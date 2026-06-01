<x-layout>
    <x-slot:heading>
        Book Details
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $book->title }}</h2>

    <p>Author: {{ $book['author'] }}</p>
    <p>Publication Year: {{ $book['publication_year'] }}</p>
    <p>Pages: {{ $book['pages'] }}</p>

    {{-- @can('edit', $book)
        <p class="mt-6">
           <x-button href="/books/{{ $book->id }}/edit">Edit Book</x-button>
        </p>
    @endcan --}}

            <p class="mt-6">
           <x-button href="/books/{{ $book->id }}/edit">Edit Book</x-button>
        </p>
</x-layout>


