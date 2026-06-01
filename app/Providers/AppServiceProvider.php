<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Observers\ProductObserver;
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
        Gate::before(function ($user, $ability) {
            return $user->isAdmin() ? true : null;
        });

        Gate::policy(Product::class, ProductPolicy::class);

        Gate::policy(Order::class, OrderPolicy::class);

        Model::preventLazyLoading(! app()->isProduction());

        Product::observe(ProductObserver::class);
    }
}
