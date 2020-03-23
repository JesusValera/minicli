<?php

declare(strict_types=1);

namespace Minicli;

final class App
{
    public function runCommand(array $argv = []): void
    {
        $name = 'World';

        if (isset($argv[1])) {
            $name = $argv[1];
        }

        echo "Hello {$name}" . PHP_EOL;
    }
}