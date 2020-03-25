<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

abstract class CommandController
{
    protected App $app;

    abstract public function run(array $argv): void;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}