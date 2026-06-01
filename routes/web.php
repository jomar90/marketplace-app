<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Route::get('/', [ProductController::class, 'index']);

// Route::get('/products/{product}', [ProductController::class, 'show']);
// Route::get('/categories/{category}', [CategoryController::class, 'show']);

// /*
// |--------------------------------------------------------------------------
// | Authenticated dashboard
// |--------------------------------------------------------------------------
// */

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// /*
// |--------------------------------------------------------------------------
// | Auth-only routes
// |--------------------------------------------------------------------------
// */

// Route::middleware('auth')->group(function () {

//     Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// /*
// |--------------------------------------------------------------------------
// | Seller-only routes
// |--------------------------------------------------------------------------
// */

// Route::middleware(['auth', 'role:seller'])->group(function () {

//     Route::get('/seller/dashboard', [SellerController::class, 'index']);

//     Route::get('/seller/products/create', [ProductController::class, 'create']);
//     Route::post('/seller/products', [ProductController::class, 'store']);

//     Route::get('/seller/products/{product}/edit', [ProductController::class, 'edit']);
//     Route::put('/seller/products/{product}', [ProductController::class, 'update']);
//     Route::delete('/seller/products/{product}', [ProductController::class, 'destroy']);
// });

/*
|--------------------------------------------------------------------------
| Buyer-only routes
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:buyer'])->group(function () {

//     Route::get('/checkout', [OrderController::class, 'create']);
//     Route::post('/checkout', [OrderController::class, 'store']);

//     Route::get('/orders', [OrderController::class, 'index']);
// });
Route::view('/', 'home');
// Route::resource('products', ProductController::class);
// Route::resource('categories', CategoryController::class);
// Route::resource('orders', OrderController::class);

// Route::resource('products', ProductController::class);
// // ->only(['index', 'show', 'search']);

// // Route::get('/products/search', [ProductController::class, 'search']);

// Route::middleware('auth')->group(function () {

//     Route::resource('products', ProductController::class)
//         ->except(['index', 'show']);

//     Route::resource('orders', OrderController::class);

//     Route::resource('categories', CategoryController::class);
// });




Route::resource('products', ProductController::class)
    ->only(['index', 'show', 'search']);

// Route::middleware('auth')->group(function () {

//     Route::resource('products', ProductController::class)
//         ->except(['index', 'show']);

    // Route::resource('categories', CategoryController::class);

    // Route::resource('orders', OrderController::class);
// });

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class)
        ->except(['index', 'show']);

    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);

    // BIDS
    Route::post('/products/{product}/bids', [BidController::class, 'store'])
        ->name('bids.store');

    // MESSAGES
    Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');

    Route::post('/messages', [MessageController::class, 'store'])
        ->name('messages.store');
});

require __DIR__.'/auth.php';
