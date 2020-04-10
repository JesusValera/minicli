<?php

declare(strict_types=1);

namespace JesusValera\Minicli\Command;

use JesusValera\Minicli\CommandInterface;
use JesusValera\Minicli\IO\PrinterInterface;

final class HelloController implements CommandInterface
{
    private PrinterInterface $printer;

    public function __construct(PrinterInterface $printer)
    {
        $this->printer = $printer;
    }

    public function run(array $args): void
    {
        /** @var string $name */
        $name = $args[2] ?? 'World';
        $this->printer->display("Hello $name");
    }
}
