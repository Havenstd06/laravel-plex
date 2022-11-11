<?php

namespace Hav2nstd06\LaravelPlex\Providers;

/*
 * Class PlexServiceProvider
 * @package Hav2nstd06\LaravelPlex
 */

use Illuminate\Support\ServiceProvider;
use Hav2nstd06\LaravelPlex\Services\Plex as PlexClient;

class PlexServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected bool $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('plex.php'),
        ]);

        // Publish Lang Files
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'plex');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerPlex();

        $this->mergeConfig();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerPlex(): void
    {
        $this->app->singleton('plex_client', static function () {
            return new PlexClient();
        });
    }

    /**
     * Merges user's and plex configs.
     *
     * @return void
     */
    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php',
            'plex'
        );
    }
}
