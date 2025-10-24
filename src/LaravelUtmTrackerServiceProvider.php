<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker;

use CodeTreeDev\LaravelUtmTracker\Middleware\CaptureUtmParameters;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class LaravelUtmTrackerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(CaptureUtmParameters::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-utm-tracker.php'),
            ], 'config');
        }

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'utm-tracker-migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-utm-tracker');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-utm-tracker', function () {
            return new LaravelUtmTracker;
        });
    }
}
