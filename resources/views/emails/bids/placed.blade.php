<x-mail::message>
    # New Bid Received

    Great news! Someone has placed a bid on your product.

    **Product:** {{ $bid->product->name }}

    **Bid Amount:** ${{ number_format($bid->amount, 2) }}

    **Bidder:** {{ $bid->user->name }}

    <x-mail::button :url="route('products.show', $bid->product)">
        View Product & Bids
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
