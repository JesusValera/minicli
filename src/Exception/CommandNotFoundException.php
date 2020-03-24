<?php

declare(strict_types=1);

namespace JesusValera\Minicli\Exception;

use Exception;

final class CommandNotFoundException extends Exception
{
    public function __construct(string $commandName)
    {
        parent::__construct("ERROR: Command \"{$commandName}\" not found.");
    }
}
