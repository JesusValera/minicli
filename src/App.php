<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use Closure;
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

    public function getCommand(string $command): ?Closure
    {
        return $this->registry[$command] ?? null;
    }

    public function runCommand(array $argv = []): void
    {
        $commandName = 'World';

        if (isset($argv[1])) {
            $commandName = $argv[1];
        }

        $command = $this->getCommand($commandName);
        if ($command === null) {
            $this->printer->display("ERROR: Command \"$commandName\" not found.");
            exit;
        }

        $command($argv);
    }
}
