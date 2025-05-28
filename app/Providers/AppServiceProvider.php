<?php

namespace App\Providers;

use App\Http\Middleware\LocaleMiddleware;
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
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        $this->app->make(\Illuminate\Routing\Router::class)
            ->pushMiddlewareToGroup('web', LocaleMiddleware::class);
    }
}
