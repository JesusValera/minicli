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

    private function getCommand(string $command): ?Closure
    {
        return $this->registry[$command] ?? null;
    }

    /** @throws \Exception */
    public function runCommand(array $argv = []): void
    {
        $commandName = 'help';

        if (isset($argv[1])) {
            $commandName = $argv[1];
        }

        $command = $this->getCommand($commandName);
        if ($command === null) {
            throw new CommandNotFoundException($commandName);
        }

        $command($argv);
    }
}
