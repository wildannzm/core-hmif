<?php

namespace App\Providers;

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
        // Dynamically set APP_URL based on the request domain
        if (app()->runningInConsole() === false) {
            $host = request()->getHost();
            $scheme = request()->getScheme();
            config(['app.url' => "{$scheme}://{$host}"]);
        }
        
        // Set locale to Indonesian for Carbon dates
        \Carbon\Carbon::setLocale('id');
        config(['app.locale' => 'id']);
    }
}
