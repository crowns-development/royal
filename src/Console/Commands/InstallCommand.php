<?php

declare(strict_types=1);

namespace CrownsDevelopment\LaravelSetup\Console\Commands;

use CrownsDevelopment\LaravelSetup\Support\RootPathResolver;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use function Laravel\Prompts\info;
use function Laravel\Prompts\note;
use function Laravel\Prompts\spin;

#[Signature('royal:install')]
#[Description('Install the Crowns Development standards.')]
final class InstallCommand extends Command
{
    public function __construct(
        private readonly RootPathResolver $pathResolver
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        info('Starting Crowns Development standards setup..');

        spin(
            callback: function () {
                $this->call('vendor:publish', [
                    '--tag' => 'crowns-standards',
                    '--force' => true,
                ]);
            },
            message: 'Publishing configuration files..',
        );

        spin(
            callback: fn () => $this->call(SetupStubsCommand::class),
            message: 'Publishing and configuring stub files..',
        );

        note('✅ Crowns Development standards setup completed.');

        return self::SUCCESS;
    }
}
