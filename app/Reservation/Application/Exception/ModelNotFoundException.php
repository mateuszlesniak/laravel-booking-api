<?php

declare(strict_types=1);

namespace App\Reservation\Application\Exception;

class ModelNotFoundException extends \Exception
{
    public function __construct(string $model)
    {
        $model = str_replace('Entity', '', explode('\\', $model)[1]);

        parent::__construct(sprintf('%s not found', $model));
    }
}
