<?php

declare(strict_types=1);

namespace JesusValera\Tests;

use JesusValera\Minicli\App;
use JesusValera\Minicli\Exception\CommandNotFoundException;
use JesusValera\Minicli\IO\CliPrinter;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    private App $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = new App(new CliPrinter());
        $this->registerCommands();
    }

    /** @test */
    public function runHelpCommand(): void
    {
        $this->app->runCommand();

        $this->expectOutputString("\nusage: minicli hello [ your-name ]\n\n");
    }

    /** @test */
    public function runHelloCommand(): void
    {
        $this->app->runCommand([1 => 'hello']);

        $this->expectOutputString("\nHello World\n\n");
    }

    /** @test */
    public function runHelloCommandWithParam(): void
    {
        $argv = [
            1 => 'hello',
            2 => 'Jesus',
        ];
        $this->app->runCommand($argv);

        $this->expectOutputString("\nHello Jesus\n\n");
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

        $this->app->runCommand($argv);
    }

    private function registerCommands(): void
    {
        $this->app->registerCommand('help', function (array $argv): void {
            $this->app->getPrinter()->display('usage: minicli hello [ your-name ]');
        });

        $this->app->registerCommand('hello', function (array $argv): void {
            $name = $argv[2] ?? 'World';
            $this->app->getPrinter()->display("Hello {$name}");
        });
    }
}
