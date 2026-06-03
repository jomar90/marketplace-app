<?php

namespace App\Observers;

use App\Events\BidCreated;
use App\Models\Bid;
use Illuminate\Support\Facades\Log;

class BidObserver
{
    /**
     * Handle the Bid "created" event.
     */
    public function created(Bid $bid): void
    {
        Log::info('Bid created', [
            'bid_id' => $bid->id,
            'user_id' => $bid->user_id,
            'product_id' => $bid->product_id,
            'amount' => $bid->amount,
        ]);

        BidCreated::dispatch($bid);
    }

    /**
     * Handle the Bid "updated" event.
     */
    public function updated(Bid $bid): void
    {
        Log::info('Bid updated', [
            'bid_id' => $bid->id,
            'amount' => $bid->amount,
        ]);
    }

    /**
     * Handle the Bid "deleted" event.
     */
    public function deleted(Bid $bid): void
    {
        Log::info('Bid deleted', [
            'bid_id' => $bid->id,
        ]);
    }
}
