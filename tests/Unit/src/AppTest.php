<?php

declare(strict_types=1);

namespace JesusValera\Tests;

use JesusValera\Minicli\App;
use JesusValera\Minicli\IO\CliPrinter;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    /** @test */
    public function runCommand(): void
    {
        (new App(new CliPrinter()))->runCommand();

        $this->expectOutputString("\nHello World\n\n");
    }

    /** @test */
    public function runCommandWithParam(): void
    {
        $argv = [];
        $argv[1] = 'Jesus';
        (new App(new CliPrinter()))->runCommand($argv);

        $this->expectOutputString("\nHello Jesus\n\n");
    }
}
