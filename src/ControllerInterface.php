<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

interface ControllerInterface
{
    public function run(array $args): void;
}
