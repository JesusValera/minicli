<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

use JesusValera\Minicli\Exception\CommandNotFoundException;
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

    public function registerCommand($name, $callable): void
    {
        $this->commandRegistry->registerCommand($name, $callable);
    }

    /** @throws CommandNotFoundException */
    public function runCommand(array $argv = []): void
    {
        $commandName = $argv[1] ?? 'help';

        $command = $this->commandRegistry->getCommand($commandName);

        if (null === $command) {
            throw new CommandNotFoundException($commandName);
        }

        $command($argv);
    }
}
