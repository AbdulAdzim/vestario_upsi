<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS in production or when explicitly configured
        if ($this->app->environment('production') || config('app.force_https')) {
            URL::forceScheme('https');
        }
    }
}
