<?php

declare(strict_types=1);

namespace App\Application;

abstract class RequestPayload implements PayloadObject
{
    protected array $requiredFields = [];

    #[\Override]
    public function validatePayload(): void
    {
        foreach ($this->requiredFields as $requiredField) {
            $getter = 'get'.ucfirst($requiredField);
            if (!method_exists($this, $getter)) {
                throw new MissingImplementationException(get_class($this), $getter);
            }

            if (empty($this->$getter())) {
                throw new \InvalidArgumentException($requiredField);
            }
        }
    }
}
