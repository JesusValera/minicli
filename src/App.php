<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use JesusValera\Minicli\IO\CliPrinter;

final class App
{
    private CliPrinter $printer;

    public function __construct(CliPrinter $printer)
    {
        $this->printer = $printer;
    }

    public function runCommand(array $argv = []): void
    {
        $name = 'World';

        if (isset($argv[1])) {
            $name = $argv[1];
        }

        $this->printer->display("Hello {$name}");
    }
}
