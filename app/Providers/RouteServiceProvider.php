<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('temp-mail', function (Request $request) {
            return Limit::perMinute(20)
                ->by($request->ip())
                ->response(function () {
                    SecurityLog::record('rate_limit'); // log the hit
                    return response()->json(['error' => 'too_many_requests'], 429);
                });
        });
    }
}
