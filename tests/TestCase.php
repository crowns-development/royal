<?php

declare(strict_types=1);

namespace CrownsDevelopment\LaravelSetup\Tests;

use CrownsDevelopment\LaravelSetup\LaravelSetupServiceProvider;
use CrownsDevelopment\LaravelSetup\Support\RootPathResolver;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelSetupServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     * Use this if you need to mock config variables or set up database paths.
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Example: If you need to force a specific config value during tests:
        // $app['config']->set('app.name', 'Crowns Development Setup Test');
    }
}