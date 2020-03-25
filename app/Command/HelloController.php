<?php

declare(strict_types=1);

namespace JesusValera\App\Command;

use JesusValera\Minicli\CommandController;

final class HelloController extends CommandController
{
    public function run(array $argv): void
    {
        $name = isset ($argv[2]) ? $argv[2] : "World";
        $this->app->getPrinter()->display("Hello $name");
    }
}
