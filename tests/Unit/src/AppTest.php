<?php

declare(strict_types=1);

namespace JesusValera\Tests;

use JesusValera\Minicli\App;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    /** @test */
    public function runCommand(): void
    {
        (new App())->runCommand();

        $this->expectOutputString("Hello World\n");
    }

    /** @test */
    public function runCommandWithParam(): void
    {
        $argv = [];
        $argv[1] = 'Jesus';
        (new App())->runCommand($argv);

        $this->expectOutputString("Hello Jesus\n");
    }
}
