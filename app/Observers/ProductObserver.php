<?php

namespace App\Observers;

use App\Events\ProductCreated;
use App\Jobs\RemoveProductFromSearchJob;
use App\Jobs\SendProductCreatedMailJob;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->clearProductCache();

        Log::info('Product created', [
            'product_id' => $product->id,
            'user_id' => $product->user_id,
        ]);

        ProductCreated::dispatch($product);

        // SendProductCreatedMailJob::dispatch($product);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->clearProductCache();

        Log::info('Product updated', [
            'product_id' => $product->id,
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->clearProductCache();

        Log::info('Product deleted', [
            'product_id' => $product->id,
        ]);

        // RemoveProductFromSearchJob::dispatch($product->id);
    }

    /**
     * Clear all product-related cache.
     */
    private function clearProductCache(): void
    {
        Cache::forget('products');
    }
}
