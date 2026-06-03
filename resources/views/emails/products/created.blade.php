<x-mail::message>
# Product Created Successfully

Your product **{{ $product->name }}** has been successfully published on the marketplace.

**Details:**

- **Price:** ${{ number_format($product->price, 2) }}
- **Stock:** {{ $product->stock }} units
- **Category:** {{ $product->category->name }}

**Description:**

{{ $product->description }}

<x-mail::button :url="route('products.show', $product)">
View Your Product
</x-mail::button>

Thank you for listing on our marketplace!

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
