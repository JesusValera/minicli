<?php

declare(strict_types=1);

namespace JesusValera\MinicliTests\Unit\Command;

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

        (new HelloController($printer))->run([1 => 'hello']);
    }

    /** @test */
    public function runCustomName(): void
    {
        $printer = $this->createMock(PrinterInterface::class);
        $printer->expects(self::once())->method('display')->with('Hello Jesus');

        (new HelloController($printer))->run([
            1 => 'hello',
            2 => 'Jesus',
        ]);
    }
}
