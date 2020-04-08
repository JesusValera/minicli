<?php

declare(strict_types=1);

namespace JesusValera\Tests\Src;

use JesusValera\Minicli\IO\CliPrinter;
use PHPUnit\Framework\TestCase;

final class CliPrinterTest extends TestCase
{
    /** @test */
    public function display(): void
    {
        $message = 'Hello :)';
        (new CliPrinter())->display($message);

        $this->expectOutputString("\n{$message}\n\n");
    }
}
