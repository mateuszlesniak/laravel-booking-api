<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

class IncorrectEmailFormatException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Must be a valid email address');
    }
}
