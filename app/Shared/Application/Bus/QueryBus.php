<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus;

use App\Shared\Application\Bus\Query\Query;

interface QueryBus
{
    public function query(Query $query): void;

    public function register(array $map): void;
}
