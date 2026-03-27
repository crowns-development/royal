<?php

declare(strict_types=1);

use CrownsDevelopment\LaravelSetup\Console\Commands\InstallCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


it('runs the install command successfully', function () {
    Artisan::call(InstallCommand::class);

    expect(File::exists(base_path('pint.json')))->toBeTrue();
    expect(File::exists(base_path('phpstan.neon')))->toBeTrue();

    expect(File::isDirectory(base_path('stubs')))->toBeTrue();
    expect(File::allFiles(base_path('stubs')))->not->toBeEmpty();
})->only();