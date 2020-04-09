<?php

declare(strict_types=1);

namespace JesusValera\MinicliTests;

use JesusValera\Minicli\App;
use JesusValera\Minicli\Exception\CommandNotFoundException;
use JesusValera\Minicli\IO\PrinterInterface;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    /** @test */
    public function runHelpByDefaultCommand(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display');

        $app = (new App())
            ->registerCommand('help', fn() => $printer->display('anything'));

        $app->runCommand([]);
    }

    /** @test */
    public function runCommandWithArgs(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('second');

        $app = (new App())
            ->registerCommand('first', fn(array $args) => $printer->display($args[2]));

        $app->runCommand([1 => 'first', 2 => 'second']);
    }

    /** @test */
    public function runNonExistentCommand(): void
    {
        $commandName = 'foo';

        $this->expectException(CommandNotFoundException::class);
        $this->expectExceptionMessage("ERROR: Command \"{$commandName}\" not found.");

        (new App())->runCommand([1 => $commandName]);
    }
}
