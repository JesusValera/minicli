<?php

declare(strict_types=1);

namespace JesusValera\Minicli\IO;

interface PrinterInterface
{
    public function display(string $message): void;
}
