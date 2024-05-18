<?php

namespace App\Bus;

use Illuminate\Bus\Dispatcher;

readonly class IlluminateQueryBus implements QueryBus
{

    public function __construct(
        protected Dispatcher $bus,
    )
    {
    }

    #[\Override] public function query(Query $query): void
    {
        $this->bus->dispatch($query);
    }

    #[\Override] public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
