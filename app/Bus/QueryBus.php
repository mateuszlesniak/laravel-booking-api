<?php

namespace App\Bus;

interface QueryBus
{
    public function query(Query $query): void;

    public function register(array $map): void;
}
