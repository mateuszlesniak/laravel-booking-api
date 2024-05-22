<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Exception;

class NotSelectedPersons extends \Exception
{
    public function __construct()
    {
        parent::__construct('Create reservation for at least 1 person');
    }
}
