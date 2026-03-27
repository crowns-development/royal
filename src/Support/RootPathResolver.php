<?php

declare(strict_types=1);

namespace CrownsDevelopment\LaravelSetup\Support;

final class RootPathResolver
{
    public function path(string $path = ''): string
    {
        return base_path() . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : '');
    }
}
