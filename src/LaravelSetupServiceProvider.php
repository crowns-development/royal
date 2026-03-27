<?php

declare(strict_types=1);

namespace CrownsDevelopment\LaravelSetup;

use CrownsDevelopment\LaravelSetup\Support\RootPathResolver;
use Illuminate\Support\ServiceProvider;

final class LaravelSetupServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \CrownsDevelopment\LaravelSetup\Console\Commands\InstallCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../resources/pint.json' => base_path('pint.json'),
                __DIR__.'/../resources/phpstan.neon' => base_path('phpstan.neon'),
            ], 'crowns-standards');
        }
    }

    public function register()
    {
        $this->app->singleton(RootPathResolver::class);
    }
}