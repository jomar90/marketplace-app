<x-layout>
    <x-slot:heading>
        {{-- {{ __('products.name') }} --}}
        Products
    </x-slot:heading>


        <a href="/lang/en">En</a> |
        <a href="/lang/nl">NL</a>

    <form
    method="GET"
    action="{{ route('products.index') }}"
    class="flex items-center gap-2 mb-6"
>
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                class="w-72 pl-3 pr-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <x-form-button>
            Search
        </x-form-button>
    </form>

    <div class="space-y-4">
        @foreach ($products as $product)
            <div class="px-4 py-6 border border-gray-200 rounded-lg">

                <div class="font-bold text-blue-500 text-sm">
                    <a href="/sellers/{{ $product->user?->id }}">
                        {{ $product->user?->name }}
                    </a>
                </div>

                <div>
                    <strong>
                        <a href="/products/{{ $product->id }}" class="text-blue-600">

                            {{ $product->name }}
                        </a>
                    </strong>

                        @if ($product->is_promoted)
                            <span class="px-2 py-1 text-xs font-semibold text-white bg-yellow-500 rounded">
                                ⭐ Promoted
                            </span>
                        @endif
                </div>

                <div>
                    <strong>
                        <a href="{{ route('products.show', $product) }}" class="text-blue-600">
                            €{{ number_format($product->price, 2) }}
                        </a>
                    </strong>
                </div>

            </div>

        @endforeach
        <div>
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
