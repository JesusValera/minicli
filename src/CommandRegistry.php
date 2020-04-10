<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;
use JesusValera\Minicli\Exception\CommandNotFoundException;

final class CommandRegistry
{
    /** @var array */
    private $registry = [];

    /** @var array */
    private $controllers = [];

    public function registerController(string $commandName, CommandInterface $commandController): void
    {
        $this->controllers = [$commandName => $commandController];
    }

    public function registerCommand(string $name, Closure $callable): void
    {
        $this->registry[$name] = $callable;
    }

    /** @throws CommandNotFoundException */
    public function getCallable(string $commandName, array $argv): void
    {
        /** @var null|CommandInterface $controller */
        $controller = $this->controllers[$commandName] ?? null;

        if ($controller instanceof CommandInterface) {
            $controller->run($argv);

            return;
        }

        $command = $this->registry[$commandName] ?? null;

        if ($command instanceof Closure) {
            $command($argv);

            return;
        }

        throw new CommandNotFoundException($commandName);
    }
}
