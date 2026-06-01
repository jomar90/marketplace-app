<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;

class OrderService
{
    public function create(array $items, int $userId): Order
    {
        $productIds = collect($items)->pluck('product_id');

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $this->validateItems($items, $products);

        $total = $this->calculateTotal($items, $products);

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        $this->attachProducts($order, $items);

        return $order;
    }

    private function validateItems(array $items, Collection $products): void
    {
        foreach ($items as $item) {
            if (! isset($products[$item['product_id']])) {
                throw new \InvalidArgumentException('Invalid product in order.');
            }

            if ($item['quantity'] <= 0) {
                throw new \InvalidArgumentException('Invalid quantity.');
            }
        }
    }

    private function calculateTotal(array $items, Collection $products): int
    {
        return collect($items)->reduce(function ($carry, $item) use ($products) {
            $product = $products[$item['product_id']];

            return $carry + ($product->price * $item['quantity']);
        }, 0);
    }

    private function attachProducts(Order $order, array $items): void
    {
        foreach ($items as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
            ]);
        }
    }
}
