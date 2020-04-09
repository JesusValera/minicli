<?php

declare(strict_types=1);

namespace JesusValera\Minicli\IO;

final class CliPrinter implements PrinterInterface
{
    public function display(string $message): void
    {
        echo "\n{$message}\n\n";
    }
}
