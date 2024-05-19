<?php

declare(strict_types=1);

namespace App\Application;

class MissingImplementationException extends \Exception
{
    public function __construct(string $class, string $missingMethod)
    {
        parent::__construct(sprintf('Missing method "%s" in class "%s"', $missingMethod, $class));
    }
}
