<?php

declare(strict_types=1);

namespace App\Common\Domain\Exception;

class UnauthorizedUserException extends \DomainException
{
    public function __construct(string $custom_message = '')
    {
        parent::__construct($custom_message ?: 'The user is not authorized to access this resource or perform this action');
    }
}
