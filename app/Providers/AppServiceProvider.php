<?php

namespace App\Providers;

use App\Interfaces\SmsGatewayInterface;
use App\SmsGateway\TwilioSmsGateway;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     */
    public function register(): void
    {
        $this->registerBindings();
        $this->registerTelescope();
    }

    /**
     * Bootstrap application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        Schema::defaultStringLength(191);
    }

    /**
     * Register interface bindings.
     */
    protected function registerBindings(): void
    {
        //
    }

    /**
     * Register Telescope only in local/development environment.
     */
    protected function registerTelescope(): void
    {
        if ($this->app->environment(['local', 'development'])) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(\App\Providers\TelescopeServiceProvider::class);
        }
    }

    /**
     * Configure API rate limiting.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?? $request->ip()
            );
        });
    }
}
