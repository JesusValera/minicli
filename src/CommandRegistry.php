<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;
use JesusValera\Minicli\Exception\CommandNotFoundException;

final class CommandRegistry
{
    private array $registry = [];

    private array $controllers = [];

    public function registerController(string $commandName, ControllerInterface $commandController): void
    {
        $this->controllers = [$commandName => $commandController];
    }

    public function registerCommand(string $name, Closure $callable): void
    {
        $this->registry[$name] = $callable;
    }

    /** @throws CommandNotFoundException */
    public function getCallable(string $commandName, array $args): void
    {
        /** @var null|ControllerInterface $controller */
        $controller = $this->controllers[$commandName] ?? null;

        if ($controller instanceof ControllerInterface) {
            $controller->run($args);

            return;
        }

        /** @var null|Closure $command */
        $command = $this->registry[$commandName] ?? null;

        if ($command instanceof Closure) {
            $command($args);

            return;
        }

        throw new CommandNotFoundException($commandName);
    }
}
