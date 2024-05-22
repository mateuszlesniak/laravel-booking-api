<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Exception;

class RequiredException extends \DomainException
{
    public function __construct($fieldName)
    {
        parent::__construct(sprintf('Field `%s` is required', $fieldName));
    }
}
