<?php

namespace App\Application;

use Exception;

class MissingImplementationException extends Exception
{

    public function __construct(string $class, string $missingMethod)
    {
        parent::__construct(sprintf('Missing method "%s" in class "%s"',  $missingMethod,$class));
    }
}
