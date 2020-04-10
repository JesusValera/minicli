<?php

declare(strict_types=1);

namespace JesusValera\Minicli;

interface CommandInterface
{
    public function run(array $args): void;
}
