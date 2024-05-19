<?php

namespace App\Application;

interface PayloadObject
{
    public function validatePayload(): void;
}
