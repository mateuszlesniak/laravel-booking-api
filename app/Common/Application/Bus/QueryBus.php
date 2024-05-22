<?php

declare(strict_types=1);

namespace App\Common\Application\Bus;

use App\Common\Application\Bus\Query\Query;

interface QueryBus
{
    public function query(Query $query): void;

    public function register(array $map): void;
}
