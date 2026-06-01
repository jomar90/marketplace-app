<x-layout>
    <x-slot:heading>
        Product Description
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $product->name }}</h2>

    <div class="mt-4 grid grid-cols-[120px_1fr] gap-y-2">
        <span class="font-semibold">Slug</span>
        <span>{{ $product->slug }}</span>

        <span class="font-semibold">Price</span>
        <span>€{{ $product->price }}</span>

        <span class="font-semibold">Stock</span>
        <span>{{ $product->stock }}</span>

        <span class="font-semibold">Category</span>
        <span>{{ $product->category->name }}</span>

        <span class="font-semibold">Description</span>
        <span>{{ $product->description }}</span>
    </div>

    <p class="mt-6">
        <x-button href="/products/{{ $product->id }}/edit">Edit product</x-button>
    </p>

    {{-- BIDS --}}
    <div class="mt-10">
        <h3 class="font-bold text-lg">Bids</h3>

        <div class="mt-2 space-y-2">
            @forelse($product->bids as $bid)
                <div class="border-b pb-1">
                    <span class="font-semibold">
                        {{ $bid->user->name }}
                    </span>
                    bid
                    €{{ $bid->amount }}
                </div>
            @empty
                <p>No bids yet.</p>
            @endforelse
        </div>

        {{-- BID FORM --}}
        <form method="POST" action="{{ route('bids.store', $product) }}" class="mt-4">
            @csrf

            <input type="number" step="0.01" name="amount" class="border p-2" placeholder="Your bid">

            <button class="bg-blue-500 text-white px-3 py-1 ml-2">
                Place Bid
            </button>
        </form>
    </div>

    {{-- MESSAGE SELLER --}}
    <div class="mt-10">
        <h3 class="font-bold text-lg">Contact Seller</h3>

        <form method="POST" action="{{ route('messages.store') }}" class="mt-2">
            @csrf

            <input type="hidden" name="receiver_id" value="{{ $product->user_id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <textarea name="message" class="border p-2 w-full" placeholder="Write your message"></textarea>

            <button class="bg-green-500 text-white px-3 py-1 mt-2">
                Send Message
            </button>
        </form>
    </div>
</x-layout>
