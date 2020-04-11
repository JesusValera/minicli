<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;

final class App
{
    private CommandRegistry $commandRegistry;

    public function __construct()
    {
        $this->commandRegistry = new CommandRegistry();
    }

    public function registerController(string $name, CommandInterface $controller): self
    {
        $this->commandRegistry->registerController($name, $controller);

        return $this;
    }

    public function registerCommand(string $name, Closure $callable): self
    {
        $this->commandRegistry->registerCommand($name, $callable);

        return $this;
    }

    public function runCommand(array $args): void
    {
        /** @var string $commandName */
        $commandName = $args[1] ?? 'help';

        $this->commandRegistry->getCallable($commandName, $args);
    }
}
