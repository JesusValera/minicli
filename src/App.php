<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;
use JesusValera\Minicli\Exception\CommandNotFoundException;
use JesusValera\Minicli\IO\CliPrinter;

final class App
{
    private CliPrinter $printer;

    /** @var array */
    private $registry = [];

    public function __construct(CliPrinter $printer)
    {
        $this->printer = $printer;
    }

    public function getPrinter(): CliPrinter
    {
        return $this->printer;
    }

    public function registerCommand(string $name, Closure $callable): void
    {
        $this->registry[$name] = $callable;
    }

    /** @throws CommandNotFoundException */
    public function runCommand(array $argv = []): void
    {
        $commandName = $argv[1] ?? 'help';

        $command = $this->getCommand($commandName);

        if (null === $command) {
            throw new CommandNotFoundException($commandName);
        }

        $command($argv);
    }

    private function getCommand(string $command): ?Closure
    {
        return $this->registry[$command] ?? null;
    }
}
