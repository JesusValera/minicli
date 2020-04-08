<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

final class App
{
    private CommandRegistry $commandRegistry;

    public function __construct()
    {
        $this->commandRegistry = new CommandRegistry();
    }

    public function registerController(string $name, CommandInterface $controller): void
    {
        $this->commandRegistry->registerController($name, $controller);
    }

    public function registerCommand(string $name, callable $callable): void
    {
        $this->commandRegistry->registerCommand($name, $callable);
    }

    public function runCommand(array $argv = [], string $defaultCommand = 'help'): void
    {
        $commandName = $argv[1] ?? $defaultCommand;

        $this->commandRegistry->getCallable($commandName, $argv);
    }
}
