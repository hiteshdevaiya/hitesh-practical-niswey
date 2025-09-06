<?php

namespace App\Providers;

use App\Models\Admin;
use App\Telescope\TelescopeFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    public function boot(): void
    {
        parent::boot();
        $this->gate();
        Telescope::auth(function ($request) {
            Auth::shouldUse('admin');
            return Gate::allows('viewTelescope');
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        $isLocal = $this->app->environment('local');

        $isDevelopment = $this->app->environment('development');

        Telescope::filter(function (IncomingEntry $entry) use ($isLocal, $isDevelopment) {
            if ($entry->type === 'request' && !request()->is('api/*')) {
                return false;
            }
            return $isLocal ||
                   $isDevelopment ||
                   $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
                   $entry->hasMonitoredTag();
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local') || $this->app->environment('development')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return $user instanceof Admin;
        });
    }
}
