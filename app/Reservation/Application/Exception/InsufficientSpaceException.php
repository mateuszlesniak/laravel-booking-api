<?php

declare(strict_types=1);

namespace App\Reservation\Application\Exception;

class InsufficientSpaceException extends \Exception
{
    public function __construct()
    {
        parent::__construct('There are no places available in the given time slot');
    }
}
