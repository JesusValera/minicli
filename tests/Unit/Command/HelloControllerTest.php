<?php

declare(strict_types=1);

namespace JesusValera\MinicliTests\Command;

use JesusValera\Minicli\App;
use JesusValera\Minicli\Command\HelloController;
use JesusValera\Minicli\IO\PrinterInterface;
use PHPUnit\Framework\TestCase;

final class HelloControllerTest extends TestCase
{
    /** @test */
    public function runNoParams(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('Hello World');

        $app = new App();
        $hello = new HelloController($printer);
        $app->registerController('hello', $hello);

        $app->runCommand([1 => 'hello']);
    }

    /** @test */
    public function runCustomName(): void
    {
        $args = [
            1 => 'hello',
            2 => 'Jesus',
        ];
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('Hello Jesus');

        $app = new App();
        $hello = new HelloController($printer);
        $app->registerController('hello', $hello);

        $app->runCommand($args);
    }
}
