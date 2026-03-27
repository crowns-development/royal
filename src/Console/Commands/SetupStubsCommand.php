<?php

declare(strict_types=1);

namespace CrownsDevelopment\LaravelSetup\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

use function Laravel\Prompts\error;
use function Laravel\Prompts\spin;

#[Signature('royal:stubs')]
#[Description('Generate stub files and apply Crowns Development standards.')]
final class SetupStubsCommand extends Command
{
    public function handle(): int
    {
        $script = <<<'BASH'
            # 1. Publish stubs if they don't exist
            if [ ! -d "stubs" ]; then
                php artisan stub:publish
            fi

            echo "Processing stubs (Strict Types + Selective DocBlocks)..."

            STUBS_DIR="$(pwd)/stubs"

            find "$STUBS_DIR" -name "*.stub" -type f | while read -r FILE; do

                perl -i -0777 -pe 's/^<\?php(?!\n\ndeclare\(strict_types=1\);)/<?php\n\ndeclare(strict_types=1);/g' "$FILE"

                perl -i -0777 -pe '
                    s{ ([ \t]*) (/\*\* .*? \*/) \s* \n }{
                        my $indent = $1;
                        my $block = $2;
                        if ($block =~ /\@/) {
                            my @lines = split(/\n/, $block);
                            my @kept = grep { / \/\*\* | \@ | \s*\*\/ /x } @lines;
                            $kept[0] = $indent . $kept[0];
                            join("\n", @kept) . "\n";
                        } else {
                            "";
                        }
                    }gesx' "$FILE"

                perl -i -pe 's/[ \t]+$//' "$FILE"
                perl -i -0777 -pe 's/\n{3,}/\n\n/g' "$FILE"

            done
        BASH;

    $result = spin(
        callback: fn () => Process::run("bash -c " . escapeshellarg($script)),
        message: 'Configuring stubs...',
    );

    if ($result->failed()) {
        error('Failed to configure stubs.');
        return self::FAILURE;
    }

    return self::SUCCESS;
    }

    private function addStrictTypes(string $file): void
    {
        $contents = File::get($file);

        if (! str_contains($contents, 'declare(strict_types=1)')) {
            $contents = preg_replace(
                '/^<\?php\s*/',
                "<?php\n\ndeclare(strict_types=1);\n\n",
                $contents,
                1
            );
        }

        File::put($file, $contents);
    }

    private function cleanDocBlocks(string $file): void
    {
        $contents = File::get($file);

        $contents = preg_replace('/[ \t]+$/m', '', $contents);
        $contents = preg_replace("/\n{3,}/", "\n\n", $contents);

        File::put($file, $contents);
    }

    private function trimWhitespace(string $file): void
    {
        $contents = File::get($file);

        $contents = preg_replace('/[ \t]+$/m', '', $contents);

        File::put($file, $contents);
    }
}
