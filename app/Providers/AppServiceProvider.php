<?php

namespace App\Providers;

use App\Models\Bid;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Observers\BidObserver;
use App\Observers\ProductObserver;
use App\Policies\BidPolicy;
use App\Policies\MessagePolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Admin can do everything
        Gate::before(function ($user, $ability) {
            return $user->isAdmin() ? true : null;
        });

        // Register all policies
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(Bid::class, BidPolicy::class);
        Gate::policy(Message::class, MessagePolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);

        Model::preventLazyLoading(! app()->isProduction());

        // Register observers
        Product::observe(ProductObserver::class);
        Bid::observe(BidObserver::class);
    }
}
