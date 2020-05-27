<?php

declare(strict_types=1);

namespace JesusValera\MinicliTests\Unit;

use JesusValera\Minicli\App;
use JesusValera\Minicli\ControllerInterface;
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
            ->registerCommand('help', fn () => $printer->display('anything'));

        $app->runCommand([]);
    }

    /** @test */
    public function runCommandWithArgs(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('second');

        $app = (new App())
            ->registerCommand('first', fn (array $args) => $printer->display($args[2]));

        $app->runCommand([1 => 'first', 2 => 'second']);
    }

    /** @test */
    public function runNonExistentCommandOrController(): void
    {
        $commandName = 'foo';

        $this->expectException(CommandNotFoundException::class);
        $this->expectExceptionMessage("ERROR: Command \"{$commandName}\" not found.");

        (new App())->runCommand([1 => $commandName]);
    }

    /** @test */
    public function runExistentController(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('second');

        $controller = new class($printer) implements ControllerInterface {
            private PrinterInterface $printer;

            public function __construct(PrinterInterface $printer)
            {
                $this->printer = $printer;
            }

            public function run(array $args): void
            {
                $this->printer->display($args[2]);
            }
        };

        $app = (new App())
            ->registerController('first', $controller);

        $app->runCommand([1 => 'first', 2 => 'second']);
    }
}
