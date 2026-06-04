<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($request->available, function ($query) {
                $query->where('stock', '>', 0);
            })
            ->with(['user', 'category'])
            ->orderBy('price', 'asc')
            ->paginate(5)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('bids.user', 'category');

        return view('products.show', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->name),
            'is_promoted' => $request->boolean('is_promoted'),
        ]);

        Cache::forget('products');

        return redirect()
            ->route('products.index')
            ->with('status', 'product-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $categories = Category::all();

        $users = User::all();

        return view('products.edit', compact(
            'product',
            'categories',
            'users'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        // Only admins may change seller ownership
        if (! auth()->user()->isAdmin()) {
            unset($data['user_id']);
        }

        $data['slug'] = Str::slug($request->name);

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('status', 'product-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Gate::authorize('delete', $product);
        $this->authorize('delete', $product);

        $product->delete();

        Cache::forget('products');

        return redirect()->route('products.index')->with('status', 'product-deleted');
    }
}
