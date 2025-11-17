<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use View;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superAdmin') ? true : null;
        });
        Paginator::useBootstrapFive();
        if (request()->header('x-forwarded-proto') == 'https' || app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('frontend.layout.header', function ($view) {
            $categories = Category::where('isVisible', 1)
                ->orderBy('catId')->get();
            $view->with('categories', $categories);
        });
    }
}
