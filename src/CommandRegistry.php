<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;

final class CommandRegistry
{
    /** @var array */
    private $registry = [];

    public function registerCommand(string $name, Closure $callable): void
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand(string $command): ?Closure
    {
        return $this->registry[$command] ?? null;
    }
}
