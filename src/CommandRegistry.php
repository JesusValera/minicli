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
    protected $controllers = [];

    public function registerController(string $commandName, CommandController $commandController): void
    {
        $this->controllers = [$commandName => $commandController];
    }

    public function registerCommand(string $name, Closure $callable): void
    {
        $this->registry[$name] = $callable;
    }

    private function getController(string $command): ?CommandController
    {
        return $this->controllers[$command] ?? null;
    }

    private function getCommand(string $command): ?Closure
    {
        return $this->registry[$command] ?? null;
    }

    /** @throws CommandNotFoundException */
    public function getCallable(string $commandName, array $argv): void
    {
        $controller = $this->getController($commandName);

        if ($controller instanceof CommandController) {
            $controller->run($argv);
            return;
        }

        $command = $this->getCommand($commandName);

        if (null === $command) {
            throw new CommandNotFoundException($commandName);
        }

        $command([$argv]);
    }
}
