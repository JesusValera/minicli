<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use JesusValera\Minicli\IO\CliPrinter;

final class App
{
    private CliPrinter $printer;

    private CommandRegistry $commandRegistry;

    public function __construct(CliPrinter $printer)
    {
        $this->printer = $printer;
        $this->commandRegistry = new CommandRegistry();
    }

    public function getPrinter(): CliPrinter
    {
        return $this->printer;
    }

    public function registerController(string $name, CommandController $controller): void
    {
        $this->commandRegistry->registerController($name, $controller);
    }

    public function registerCommand($name, $callable): void
    {
        $this->commandRegistry->registerCommand($name, $callable);
    }

    public function runCommand(array $argv = [], string $defaultCommand = 'help'): void
    {
        $commandName = $argv[1] ?? $defaultCommand;

        $this->commandRegistry->getCallable($commandName, $argv);
    }
}
