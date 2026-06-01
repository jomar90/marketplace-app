<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Session\Store;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::with('user', 'products')
            ->latest()
            ->paginate(5);

        return view('orders.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('orders.create', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $items = $request->validated()['items'];

        $order = $this->orderService->create(
            $items,
            auth()->id()
        );

        return redirect()
            ->route('orders.index')
            ->with('status', 'order-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('update', $order);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);

        $order->update([
            'status' => $request->validated('status'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('status', 'order-deleted');
    }
}
