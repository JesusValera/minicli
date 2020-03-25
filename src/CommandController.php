<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

abstract class CommandController
{
    protected App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    abstract public function run(array $argv): void;
}
