<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        View::composer('*', function ($view) {
            try {
                $enabled = SiteSetting::get('module_price_enabled', '0') === '1';
                $view->with('modulePriceEnabled', $enabled);
            } catch (\Throwable $e) {
                $view->with('modulePriceEnabled', false);
            }
        });
    }
}
