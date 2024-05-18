<?php

namespace App\Bus;

interface CommandBus
{
    public function dispatch(Command $command): void;

    public function register(array $map): void;
}