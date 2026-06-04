<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

// Public routes - no authentication required
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Protected routes - authentication required
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
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

    Route::get('/messages/{message}', [MessageController::class, 'show'])
        ->name('messages.show');
});

require __DIR__.'/auth.php';
