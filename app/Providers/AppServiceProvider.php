<?php

namespace App\Providers;

use App\Models\PurchaseItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // bootstrap paginator
        Paginator::useBootstrapFive();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });

        View::composer('*', function ($view) {

            $purchasedItemIds = collect();

            if (auth()->check()) {
                $purchasedItemIds = PurchaseItem::where('user_id', auth()->id())
                    ->whereHas('purchase', fn($q) => $q->where('status', 'completed'))
                    ->pluck('item_id')
                    ->map(fn($id) => (int) $id);
            }

            $view->with('purchasedItemIds', $purchasedItemIds);
        });
    }
}
