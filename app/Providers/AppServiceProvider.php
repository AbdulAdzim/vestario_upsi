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
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }
    }
}
