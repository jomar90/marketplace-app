<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBidRequest;
use App\Http\Requests\UpdateBidRequest;
use App\Models\Bid;
use App\Models\Product;

class BidController extends Controller
{
    public function index(Product $product)
    {
        $bids = $product->bids()
            ->with('user')
            ->latest()
            ->get();

        return view('bids.index', compact('bids', 'product'));
    }

    public function create()
    {
        return view('bids.create', compact('bids'));
    }

    public function store(StoreBidRequest $request, Product $product)
    {
        if (auth()->id() === $product->user_id) {
            abort(403);
        }
        Bid::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'bid-created');
    }

    public function show()
    {
        return view('bids.show', compact('bids'));
    }

    public function edit()
    {
        return view('bids.edit');
    }

    public function update(UpdateBidRequest $request, Bid $bid)
    {
        $bid->update($request->validated());

        return redirect()
            ->route('products.show', $bid->product)
            ->with('status', 'bid-updated');
    }

    public function destroy(Bid $bid)
    {
        $this->authorize('delete', $bid);
        $bid->delete();

        return redirect()
            ->route('products.show', $bid->product)
            ->with('status', 'bid-deleted');
    }
}
