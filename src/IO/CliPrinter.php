<?php

declare(strict_types=1);

namespace JesusValera\Minicli\IO;

final class CliPrinter
{
    public function display(string $message): void
    {
        $this->newLine();
        $this->out($message);
        $this->newLine();
        $this->newLine();
    }

    private function out(string $message): void
    {
        echo $message;
    }

    private function newLine(): void
    {
        $this->out("\n");
    }
}
