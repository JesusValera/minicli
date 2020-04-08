<?php

declare(strict_types=1);

namespace JesusValera\MinicliTests\Unit;

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

        $app = new App();
        $app->registerCommand('help', function () use ($printer): void {
            $printer->display('anything');
        });

        $app->runCommand([]);
    }

    /** @test */
    public function runCommandWithArgs(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('second');

        $app = new App();
        $app->registerCommand('first', function (array $args) use ($printer): void {
            $printer->display($args[2]);
        });

        $app->runCommand([1 => 'first', 2 => 'second']);
    }

    /** @test */
    public function runNonExistentCommand(): void
    {
        $commandName = 'foo';

        $this->expectException(CommandNotFoundException::class);
        $this->expectExceptionMessage("ERROR: Command \"{$commandName}\" not found.");

        $argv = [
            1 => $commandName,
        ];

        $app = new App();
        $app->runCommand($argv);
    }
}
